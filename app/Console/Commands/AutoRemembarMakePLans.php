<?php

namespace App\Console\Commands;

use App\Mail\RememberToMakePlans;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AutoRemembarMakePLans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:remembarmakepLans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $users = User::whereNotNull('email_verified_at')->get();

        if ($users->count() > 0) {
            foreach ($users as $user) {
                Mail::to($user)->send(new RememberToMakePlans($user));
            }
        }

        return Command::SUCCESS;
    }
}
