<?php

namespace Vgplay\Heros\Actions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Vgplay\Heros\Models\Hero;
use Vgplay\Heros\Traits\HasObjectListFormElement;

class UpdateHero
{
    use HasObjectListFormElement;

    public function update(Hero $hero, array $data): bool
    {
        $data = $this->validate($hero, $data);

        return $this->updateHero($hero, $data);
    }

    protected function validate(Hero $hero, array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:191',
            'clan_id' => 'nullable|exists:clans,id',
            'slug' => 'nullable|string|max:191|unique:heroes,slug,' . $hero->id,
            'image' => 'nullable|string|max:2048',
            'icon' => 'nullable|string|max:2048',
            'stats' => 'nullable|array',
            'desc' => 'nullable|string',
            'order' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data['skills'] = $this->fillObjectList($data['skills'] ?? []);

        return $data;
    }

    protected function updateHero(Hero $hero, array $data): bool
    {
        $data['slug'] = isset($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']) . '-' . time();;

        return $hero->update($data);
    }
}
