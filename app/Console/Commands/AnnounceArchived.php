<?php

namespace App\Console\Commands;

use App\Models\Announce;
use Illuminate\Console\Command;

class AnnounceArchived extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'archived:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $date_to_archived = date('Y-m-d', strtotime('1 days')); // 31 jours
        Announce::query()
            ->where('created_at', '>=', $date_to_archived)
            ->update([
                'archived' => 1
        ]);
    }
}
