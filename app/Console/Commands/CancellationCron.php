<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;

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

        foreach($transactionPending as $key => $transaction){
            // Convert the date string to a DateTime object with the Singapore time zone
            $date = new DateTime($transaction->created_at);
            
            // Get the current date/time in Singapore
            $now = new DateTime('now', new DateTimeZone('Asia/Singapore'));
            
            // Calculate the time difference between the given date and the current date
            $diff = $date->diff($now);
            
            // Check if the time difference is greater than 1 day
            if ($diff->days > 1) {
                $transaction->update([
                    'status_id' => 5 
                ]);
            }
        }
        
        // \Log::info("Cron is working fine!");
        return Command::SUCCESS;
    }
}
