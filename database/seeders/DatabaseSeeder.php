<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unguard();

        DB::beginTransaction();

        $this->call([
            UserSeeder::class,
        ]);

        DB::commit();

        Model::reguard();
    }
}
