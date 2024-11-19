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
        // Create a single test user.
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create a few entities.
        $entities = \App\Models\Customer::factory(2)
            ->create()
            ->merge(
                \App\Models\Prospect::factory(2)
                    ->create()
            );

        // Assign relations to the entities.
        foreach ($entities as $entity) {
            // Create a few contacts.
            $contacts = \App\Models\Contact::factory(2)
                ->create();

            // Assign the contacts to the entity.
            $entity->contacts()->attach($contacts->pluck('id'));
        }
    }
}

