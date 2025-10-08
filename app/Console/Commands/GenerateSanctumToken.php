<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSanctumToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sanctum-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask('Enter the user email');

        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error('User not found.');
            return;
        }

        $token = $user->createToken('RequisitionSender')->plainTextToken;

        $this->info('Sanctum Token: ' . $token);

    }
}
