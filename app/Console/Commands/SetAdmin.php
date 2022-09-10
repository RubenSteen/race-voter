<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make 110752556312965120 a admin';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (\App\Models\User::where('id', 110752556312965120)->exists()) {
            \App\Models\User::find(110752556312965120)->admin();
        }

        return 0;
    }
}
