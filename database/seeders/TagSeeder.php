<?php

namespace Database\Seeders;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'dasign'],
            ['name' => 'Marketing'],
            ['name' => 'Seo'],
            ['name' => 'Writing'],
            ['name' => 'Consulting'],
            ['name' => 'Development'],
        ];

        Tag::insert($tags);
    }
}
