<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $faker = Factory::create();

        $roles = [
            [
                'role' => 'System Admistrator',
                'accessLevel' => 100,
            ],
            [
                'role' => 'Admistrator',
                'accessLevel' => 90,
            ],
            [
                'role' => 'Manager',
                'accessLevel' => 80,
            ],
            [
                'role' => 'Sales Manager',
                'accessLevel' => 70,
            ],
            [
                'role' => 'Sales Assistant',
                'accessLevel' => 60,
            ],
            [
                'role' => 'Editor',
                'accessLevel' => 50,
            ],
            [
                'role' => 'Author',
                'accessLevel' => 40,
            ],
            [
                'role' => 'Agent',
                'accessLevel' => 30,
            ],
            [
                'role' => 'Reseller',
                'accessLevel' => 20,
            ],
            [
                'role' => 'Registered',
                'accessLevel' => 10,
            ],
        ];

        foreach ($roles as $key => $value) {
            DB::table('roles')->insert([
                'role' => $value['role'],
                'accessLevel' => $value['accessLevel'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        \App\Models\User::factory()->create([
            'firstName' => 'Airowl',
            'middleName' => 'Cuevas',
            'lastName' => 'Gasga',
            'email' => 'airowl@email.com',
            'avatar' => 'https://scontent.fmxp7-2.fna.fbcdn.net/v/t39.30808-6/326524756_1223997284869125_4228540568063008977_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=gUMynmVbeUwAX-pFRpA&_nc_ht=scontent.fmxp7-2.fna&oh=00_AfB91D-Gkz4FetgKQaaC6NzHRFXM848fjPMtev7etTnqgQ&oe=646D3DE6',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'registeredAt' => now(),
            'lastLogin' => now(),
            'status' => 'inactive',
            'intro' => Str::random(50),
            'role_id' => 1
        ]);

        $languages = array(
            [
                'languageCode' => 'it',
            ],
            [
                'languageCode' => 'en',
            ],
        );

        foreach ($languages as $key => $value) {
            DB::table('local_languages')->insert([
                'languageCode' => $value['languageCode'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $translations = array(
            [
                'languageCode' => 1,
                'translation' => 'ciao',
            ],
            [
                'languageCode' => 2,
                'translation' => 'hello',
            ],
            [
                'languageCode' => 1,
                'translation' => 'come stai?',
            ],
            [
                'languageCode' => 2,
                'translation' => 'how are you?',
            ],
        );

        foreach ($translations as $key => $value) {
            DB::table('local_translations')->insert([
                'local_language_id' => $value['languageCode'],
                'translation' => $value['translation'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $title = $faker->word();
            DB::table('posts')->insert([
                'title' => $title,
                'metaTitle' => strtolower($title),
                'slug' => $title,
                'published' => 0,
                'publishedAt' => null,
                'content' => '<p>' . $faker->paragraph(4) . '</p>' . '<p>' . $faker->paragraph(4) . '</p>' . '<p>' . $faker->paragraph(4) . '</p>',
                'user_id' => 1,
            ]);
        }
    }
}
