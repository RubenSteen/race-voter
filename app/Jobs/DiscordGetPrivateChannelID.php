<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class DiscordGetPrivateChannelID implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $api_key;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->api_key = config('services.discord.token');

        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $api_key = config('services.discord.token');
        $response = Http::withHeaders([
            'Authorization' => "Bot $this->api_key",
        ])->post('https://discord.com/api/v10/users/@me/channels', [
            'recipient_id' => $this->user->id,
        ]);

        if ($response->successful()) {
            $this->user->setPrivateChannelID($response['id']);
        }
    }
}
