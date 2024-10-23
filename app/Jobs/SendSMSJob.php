<?php

namespace App\Jobs;

use App\Helpers\SMS;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSMSJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $to;

    public string $message;

    public ?string $sender;

    public ?string $provider;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($to, $message, $sender, $provider)
    {
        $this->to = $to;
        $this->message = $message;
        $this->sender = $sender;
        $this->provider = $provider;
    }

    /**
     * Execute the job.
     *
     *
     * @throws GuzzleException
     */
    public function handle(): void
    {

        (new SMS($this->provider))->sendViaSMS($this->to, $this->message, $this->sender);

    }
}
