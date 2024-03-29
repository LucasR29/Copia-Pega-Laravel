<?php

namespace Database\Seeders;

use App\Models\CollectionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CollectionItem::factory()->count(10)->create();
    }
}
