<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use Carbon\Carbon;
use DateTimeZone;
use DateTime;

class CancellationCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cancellation:cron';

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
        $transactionPending = Transaction::where('status_id', 1)->get();
        date_default_timezone_set('Asia/Singapore');
        // $singaporeTimezone = new DateTimeZone('Asia/Singapore');

        foreach($transactionPending as $key => $transaction){
            // Example date string to check
            $date_str = $transaction->created_at;
            
            // Convert the date string to a DateTime object with the Singapore time zone
            $date = new DateTime($date_str, new DateTimeZone('Asia/Singapore'));
            
            // Get the current date/time in Singapore
            $now = new DateTime('now', new DateTimeZone('Asia/Singapore'));
            
            // Calculate the time difference between the given date and the current date
            $diff = $date->diff($now);
            
            // Check if the time difference is greater than 1 day
            if ($diff->days >= 1) {
                $transaction->update([
                    'status_id' => 5 
                 ]);
            }
        }
        // $this->info('cron is working');
        // \Log::info("Cron is working fine!");
        return Command::SUCCESS;
    }
}
