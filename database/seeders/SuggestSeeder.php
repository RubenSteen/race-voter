<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Suggest;
use App\Models\Poll;

class SuggestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Poll::all() as $poll) {
            Suggest::factory()
            ->count(7)
            ->create(['poll_id' => $poll->id]);
        }
    }
}
