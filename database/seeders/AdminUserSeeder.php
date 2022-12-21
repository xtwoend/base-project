<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new \App\Models\User)->forceFill([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'root' => 1,
        ])->save();
    }
}
