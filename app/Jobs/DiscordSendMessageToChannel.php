<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class DiscordSendMessageToChannel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $api_key;

    protected $channel_id;

    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($channel_id, $message)
    {
        $this->api_key = config('services.discord.token');

        $this->channel_id = $channel_id;

        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->channel_id !== null) {
            $response = Http::withHeaders([
                'Authorization' => "Bot $this->api_key",
            ])->post("https://discord.com/api/v10/channels/$this->channel_id/messages", $this->message);
        }
    }
}
