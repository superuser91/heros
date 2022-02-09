<?php

namespace Vgplay\Heros\Actions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Vgplay\Heros\Models\Hero;
use Vgplay\Heros\Traits\HasObjectListFormElement;

class CreateHero
{
    use HasObjectListFormElement;

    /**
     * Create
     *
     * @param array $data
     * @return Hero
     */
    public function create(array $data): Hero
    {
        $data = $this->validate($data);

        return $this->createHero($data);
    }

    /**
     * Validate
     *
     * @param array $data
     * @return array
     */
    protected function validate(array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:191',
            'clan_id' => 'nullable|exists:clans,id',
            'slug' => 'nullable|string|max:191|unique:heroes,slug',
            'image' => 'nullable|string|max:2048',
            'icon' => 'nullable|string|max:2048',
            'stats' => 'nullable|array',
            'skills' => 'nullable|array',
            'desc' => 'nullable|string',
            'order' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $data['skills'] = $this->fillObjectList($data['skills'] ?? []);

        return $data;
    }

    /**
     * perform create
     *
     * @param array $data
     * @return Hero
     */
    protected function createHero(array $data): Hero
    {
        $data['slug'] = isset($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']) . '-' . time();;

        return Hero::create($data);
    }
}
