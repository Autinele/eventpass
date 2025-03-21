<?php

namespace Database\Seeders;

use App\Models\Evenement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvenementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Evenement::create([
            'titre' => 'Conférence sur la Technologie',
            'description' => 'Une conférence pour discuter des dernières innovations en technologie.',
            'statut' => 'actif',
            'date_debut' => '2025-04-01 09:00:00',
            'date_fin' => '2025-04-01 17:00:00',
            'participants_count' => 10,
            'limite_participants' => 100,
        ]);

        Evenement::create([
            'titre' => 'Atelier de développement web',
            'description' => 'Un atelier pratique sur les technologies de développement web.',
            'statut' => 'actif',
            'date_debut' => '2025-05-15 10:00:00',
            'date_fin' => '2025-05-15 16:00:00',
            'participants_count' => 20,
            'limite_participants' => 50,
        ]);

        Evenement::create([
            'titre' => 'Hackathon de programmation',
            'description' => 'Un hackathon pour développer des solutions innovantes en 24 heures.',
            'statut' => 'actif',
            'date_debut' => '2025-06-20 08:00:00',
            'date_fin' => '2025-06-21 08:00:00',
            'participants_count' => 30,
            'limite_participants' => 100,
        ]);
    }
}
