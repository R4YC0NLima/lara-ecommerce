<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $position;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($position)
    {
        $this->position = $position;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::create([
            'name' => "Teste {$this->position}",
            'email' => "teste{$this->position}@test.com",
            'password' => bcrypt("pass{$this->position}")
        ]);

        if($user) {
            dispatch(new SendEmail());
        }
        // Mail::to('teste@gmail.com')->send(new SendEmail());
    }
}
