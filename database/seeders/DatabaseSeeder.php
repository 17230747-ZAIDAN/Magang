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
        $this->call([
            NewsSeeder::class,
            MemberSeeder::class,
            DocumentSeeder::class,
            AgendaSeeder::class,
        ]);

        $this->command->info('✓ Database seeded successfully!');
        $this->command->info('');
        $this->command->info('Sample data created:');
        $this->command->info('- News: ' . \App\Models\News::count() . ' items');
        $this->command->info('- Members: ' . \App\Models\Member::count() . ' items');
        $this->command->info('- Documents: ' . \App\Models\Document::count() . ' items');
        $this->command->info('- Agendas: ' . \App\Models\Agenda::count() . ' items');
    }
}
