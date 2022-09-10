<?php

namespace App\Console\Commands;

use App\Jobs\DiscordGetPrivateChannelID;
use Illuminate\Console\Command;

class DiscordGetAllPrivateChannels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discord:get-all-private-channels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all the private channels of the users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (\App\Models\User::all() as $user) {
            DiscordGetPrivateChannelID::dispatch($user)->onQueue('discord_api');
        }
    }
}
