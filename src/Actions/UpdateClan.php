<?php

namespace Vgplay\Heros\Actions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Vgplay\Heros\Models\Clan;

class UpdateClan
{
    public function update(Clan $clan, array $data): bool
    {
        $data = $this->validate($clan, $data);

        return $this->updateClan($clan, $data);
    }

    protected function validate(Clan $clan, array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:clans,slug,' . $clan->id,
            'image' => 'nullable|string|max:2048',
            'icon' => 'nullable|string|max:2048',
            'stats' => 'nullable|array',
            'desc' => 'nullable|string',
            'order' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $data;
    }

    protected function updateClan(Clan $hero, array $data): bool
    {
        $data['slug'] = isset($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']) . '-' . time();;

        return $hero->update($data);
    }
}
