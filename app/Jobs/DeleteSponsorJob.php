<?php

namespace App\Jobs;

use App\Models\Apartment;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\VarDumper\Exception\ThrowingCasterException;

class DeleteSponsorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $apartment;
    public $sponsor_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Apartment $apartment_, $sponsor_id_)
    {
        $this->apartment = $apartment_;
        $this->sponsor_id = $sponsor_id_;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->apartment->sponsorships()->updateExistingPivot($this->sponsor_id, ["is_active" => 0]);
    }
}
