<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Sidang Paripurna', 'Rapat Komisi', 'Rapat Kerja', 'Rapat Dengar Pendapat', 'Kunjungan Kerja'];
        $commissions = ['Komisi I', 'Komisi II', 'Komisi III', 'Komisi IV', 'Komisi V', 'Komisi VI', 'Komisi VII', 'Komisi VIII', 'Komisi IX', 'Komisi X', 'Komisi XI'];
        $statuses = ['scheduled', 'ongoing', 'completed'];

        // Today's agendas
        for ($i = 0; $i < 5; $i++) {
            $startTime = now()->setHour(9 + ($i * 2))->setMinute(0);
            
            Agenda::create([
                'title' => $types[array_rand($types)] . ' - Pembahasan ' . fake()->words(3, true),
                'description' => fake()->paragraph(2),
                'type' => $types[array_rand($types)],
                'location' => fake()->randomElement(['Ruang Rapat Paripurna', 'Ruang Komisi ' . $commissions[array_rand($commissions)], 'Ruang Rapat Pimpinan']),
                'start_time' => $startTime,
                'end_time' => $startTime->copy()->addHours(2),
                'commission' => rand(0, 1) ? $commissions[array_rand($commissions)] : null,
                'status' => $i < 2 ? 'completed' : ($i == 2 ? 'ongoing' : 'scheduled'),
                'note' => fake()->sentence(),
            ]);
        }

        // This week's agendas
        for ($i = 1; $i <= 7; $i++) {
            for ($j = 0; $j < rand(2, 4); $j++) {
                $startTime = now()->addDays($i)->setHour(9 + ($j * 2))->setMinute(0);
                
                Agenda::create([
                    'title' => $types[array_rand($types)] . ' - ' . fake()->sentence(4),
                    'description' => fake()->paragraph(2),
                    'type' => $types[array_rand($types)],
                    'location' => fake()->randomElement(['Ruang Rapat Paripurna', 'Ruang Komisi ' . $commissions[array_rand($commissions)], 'Gedung Nusantara']),
                    'start_time' => $startTime,
                    'end_time' => $startTime->copy()->addHours(rand(2, 4)),
                    'commission' => rand(0, 1) ? $commissions[array_rand($commissions)] : null,
                    'status' => 'scheduled',
                    'note' => fake()->sentence(),
                ]);
            }
        }

        // Past agendas
        for ($i = 1; $i <= 30; $i++) {
            $startTime = now()->subDays($i)->setHour(rand(9, 15))->setMinute(0);
            
            Agenda::create([
                'title' => $types[array_rand($types)] . ' - ' . fake()->sentence(4),
                'description' => fake()->paragraph(2),
                'type' => $types[array_rand($types)],
                'location' => fake()->randomElement(['Ruang Rapat Paripurna', 'Ruang Komisi ' . $commissions[array_rand($commissions)], 'Gedung Nusantara']),
                'start_time' => $startTime,
                'end_time' => $startTime->copy()->addHours(rand(2, 4)),
                'commission' => rand(0, 1) ? $commissions[array_rand($commissions)] : null,
                'status' => 'completed',
                'note' => fake()->sentence(),
            ]);
        }
    }
}
