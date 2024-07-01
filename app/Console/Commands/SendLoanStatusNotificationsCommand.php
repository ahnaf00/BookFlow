<?php

namespace App\Console\Commands;

use App\Models\Landing;
use App\Notifications\LoanStatusNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendLoanStatusNotificationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loan:send-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send loan status notifications to users.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch overdue landings or adjust the query for other statuses
        $landings = Landing::with('user', 'book')->where('status', 'overdue')->get();

        foreach ($landings as $landing) {
            $user = $landing->user;
            Notification::send($user, new LoanStatusNotification($landing));
        }

        $this->info('Notifications sent successfully.');
    }
}
