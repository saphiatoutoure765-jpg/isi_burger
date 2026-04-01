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
        // Créer le gestionnaire
        $gestionnaire = new \App\Models\User();
        $gestionnaire->name = 'Gestionnaire ISI';
        $gestionnaire->email = 'gestionnaire@isiburger.sn';
        $gestionnaire->password = \Illuminate\Support\Facades\Hash::make('password');
        $gestionnaire->role = 'gestionnaire';
        $gestionnaire->save();

        // Créer un client de test
        $client = new \App\Models\User();
        $client->name = 'Client Test';
        $client->email = 'client@isiburger.sn';
        $client->password = \Illuminate\Support\Facades\Hash::make('password');
        $client->role = 'client';
        $client->save();
    }
}
