<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Airowl Gasga',
            'email' => 'airowl@email.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'avatar' => 'https://scontent.fmxp7-2.fna.fbcdn.net/v/t39.30808-6/326524756_1223997284869125_4228540568063008977_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=gUMynmVbeUwAX-pFRpA&_nc_ht=scontent.fmxp7-2.fna&oh=00_AfB91D-Gkz4FetgKQaaC6NzHRFXM848fjPMtev7etTnqgQ&oe=646D3DE6'
        ]);
    }
}
