<?php

namespace Vgplay\Heros\Actions;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Vgplay\Heros\Models\Clan;

class CreateClan
{
    /**
     * Create
     *
     * @param array $data
     * @return Clan
     */
    public function create(array $data): Clan
    {
        $data = $this->validate($data);

        return $this->createClan($data);
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
            'slug' => 'nullable|string|max:191|unique:clans,slug',
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

    /**
     * perform create
     *
     * @param array $data
     * @return Clan
     */
    protected function createClan(array $data): Clan
    {
        $data['slug'] = isset($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']) . '-' . time();;

        return Clan::create($data);
    }
}
