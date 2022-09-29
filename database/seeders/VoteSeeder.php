<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Poll;
use App\Models\User;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach (Poll::all() as $poll) {
            foreach ($poll->suggestions->random(3) as $suggest) {
                $suggest->vote()->create([
                    'poll_id' => $poll->id,
                    'user_id' => $users->random(1)->first()->id,
                ]);
            }
        }
    }
}
