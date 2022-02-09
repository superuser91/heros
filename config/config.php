<?php

return [
    'guard' => 'admin',
    'guard_model' => 'App\Models\Admin',
    'prefix' => 'admin',
    'middleware' => ['auth:admin'],
    'heros' => [
        'policy' => 'App\\Policies\\HeroPolicy',
        'stats' => [
            'level' => 'Cấp',
            'hp' => 'HP',
            'atk' => 'Công',
            'speed' => 'Tốc độ',
            'armor' => 'Giáp',
            'magic_resist' => 'Kháng phép'
        ],
        'skills' => [
            'name' => 'Tên kỹ năng',
            'desc' => 'Mô tả kỹ năng',
            'icon' => 'Link biểu tượng',
            'video' => 'Link nhúng video kỹ năng',
            'order' => 'Thứ tự',
        ]

    ],
    'clans' => [
        'policy' => 'App\\Policies\\ClanPolicy',
        'stats' => [],

    ]
];
