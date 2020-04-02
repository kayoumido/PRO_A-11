<?php

use Illuminate\Database\Seeder;

class ModelsFakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $conferences = factory(App\Conference::class, 3)->create();
        $users1 = factory(App\User::class, 3)->create();
        $users2 = factory(App\User::class, 3)->create();
        $users3 = factory(App\User::class, 3)->create();

        foreach ($conferences as $conference) {
            $conference->presentations()->createMany(factory(App\Presentation::class, 3)->make()->toArray());
            foreach ($conference->presentations as $presentation) {
                $presentation->polls()->createMany(factory(App\Poll::class, 3)->make()->toArray());
                foreach ($presentation->polls as $poll) {
                    $poll->choices()->createMany(factory(App\Choice::class, 3)->make()->toArray());
                }
                $presentation->users()->attach($users1, ['role' => 'test_presentation']);
                $users1->first()->questions()->createMany(factory(App\Question::class, 3)
                    ->make(['presentation_id' => $presentation->id])->toArray()
                );

            }
        }

        $conferences[0]->users()->attach($users1, ['role' => 'test']);
        $conferences[1]->users()->attach($users2, ['role' => 'test']);
        $conferences[2]->users()->attach($users3, ['role' => 'test']);

        // add votes to the first question
        App\Question::first()->users()->attach($users1);

        // add votes for polls
        $poll = App\Poll::first();
        $poll->users()->attach($users2, ['choice_id' => $poll->choices()->first()->id]);

    }
}
