<?php

namespace Vgplay\Heros\Tests;

use CreateHeroesTable;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Vgplay\Heros\HerosServiceProvider;

class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            HerosServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/2021_09_16_212809_create_heroes_table.php';

        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        (new \CreateHeroesTable)->up();
    }
}
