<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ModelsFakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
	DB::table('users')->insert([
		'id' => 1,
		'fname' => 'Pierre',
		'lname' => 'Martin',
		'email' => 'pierre.martin@gmail.com',
		'password' => Hash::make('pro2020'),
		]);

	DB::table('users')->insert([
		'id' => 2,
		'fname' => 'Maria',
		'lname' => 'Costa',
		'email' => 'maria.costa@heig-vd.ch',
		'password' => Hash::make('heig2020'),
		]);

	DB::table('users')->insert([
		'id' => 3,
		'fname' => 'Jacque',
		'lname' => 'Favre',
		'email' => 'jacque.favre@outlook.com',
		'password' => Hash::make('P@$$w0rd'),
		]);

	DB::table('users')->insert([
		'id' => 4,
		'fname' => 'Ana',
		'lname' => 'Smith',
		'email' => 'ana.smith@hes-so.ch',
		'password' => Hash::make('hesso2020'),
		]);

	DB::table('conferences')->insert([
		'id' => 1,
		'name' => "Bases de l'informatique",
		'date' => '2020-07-02 08:30',
		]);

	DB::table('presentations')->insert([
		'id' => 1,
		'title' => "Introduction à l'informatique",
		'date' => '2020-07-02 8:30',
		'conference_id' => '1',
		]);

	DB::table('presentations')->insert([
		'id' => 2,
		'title' => 'Les langages de programmation',
		'date' => '2020-07-02 10:25',
		'conference_id' => '1',
		]);

	DB::table('presentations')->insert([
		'id' => 3,
		'title' => 'La Sécurité informatique',
		'date' => '2020-07-02 13:30',
		'conference_id' => '1',
		]);

	DB::table('presentations')->insert([
		'id' => 4,
		'title' => "Les Système d'exploitation",
		'date' => '2020-07-02 15:00',
		'conference_id' => '1',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 1,
		'user_id' => 2,
		'role' => 'presenter',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 3,
		'user_id' => 2,
		'role' => 'presenter',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 2,
		'user_id' => 4,
		'role' => 'presenter',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 4,
		'user_id' => 4,
		'role' => 'presenter',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 1,
		'user_id' => 3,
		'role' => 'atendee',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 2,
		'user_id' => 3,
		'role' => 'atendee',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 3,
		'user_id' => 3,
		'role' => 'atendee',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 4,
		'user_id' => 3,
		'role' => 'atendee',
		]);

	DB::table('presentation_user')->insert([
		'presentation_id' => 2,
		'user_id' => 2,
		'role' => 'atendee',
		]);

	DB::table('polls')->insert([
		'id' => 1,
		'presentation_id' => 2,
		'subject' => 'Votre langage de programmation préféré ?',
		'status' => 'Texas',
	]);

	DB::table('polls')->insert([
		'id' => 2,
		'presentation_id' => 2,
		'subject' => 'Nombre de langage que vous connaissez ?',
		'status' => 'draft',
	]);

	DB::table('polls')->insert([
		'id' => 3,
		'presentation_id' => 3,
		'subject' => 'Quel sénario est le plus dangereux ?',
		'status' => 'Texas',
	]);

	DB::table('choices')->insert([
		'id' => 1,
		'message' => 'Java',
		'poll_id' => 1,
	]);

	DB::table('choices')->insert([
		'id' => 2,
		'message' => 'C++',
		'poll_id' => 1,
	]);

	DB::table('choices')->insert([
		'id' => 3,
		'message' => 'C',
		'poll_id' => 1,
	]);

	DB::table('choices')->insert([
		'id' => 4,
		'message' => 'PHP',
		'poll_id' => 1,
	]);

	DB::table('choices')->insert([
		'id' => 5,
		'message' => 'Aucun',
		'poll_id' => 1,
	]);

	DB::table('choices')->insert([
		'id' => 6,
		'message' => 'Autre',
		'poll_id' => 1,
	]);

	DB::table('choices')->insert([
		'id' => 7,
		'message' => 'Aucun',
		'poll_id' => 2,
	]);

	DB::table('choices')->insert([
		'id' => 8,
		'message' => '1',
		'poll_id' => 2,
	]);

	DB::table('choices')->insert([
		'id' => 9,
		'message' => '2',
		'poll_id' => 2,
	]);

	DB::table('choices')->insert([
		'id' => 10,
		'message' => '3',
		'poll_id' => 2,
	]);

	DB::table('choices')->insert([
		'id' => 11,
		'message' => '4 ou plus',
		'poll_id' => 2,
	]);

	DB::table('choices')->insert([
		'id' => 12,
		'message' => 'Une injection SQL',
		'poll_id' => 3,
	]);

	DB::table('choices')->insert([
		'id' => 13,
		'message' => 'Une référence directe non sécurisée',
		'poll_id' => 3,
	]);

	DB::table('choices')->insert([
		'id' => 14,
		'message' => 'Une clé de chiffrement à entropie basse',
		'poll_id' => 3,
	]);
    }
}
