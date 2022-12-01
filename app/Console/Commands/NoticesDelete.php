<?php

namespace App\Console\Commands;

use App\Models\Notices;
use DateTimeZone;
use Illuminate\Console\Command;

class NoticesDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notices:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notices delete';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $la_time = new DateTimeZone('Asia/Ashgabat');
        $date = now()->setTimezone($la_time);
        $date = $date->format('Y-m-d');

        $a = (bool)Notices::where('date', '<=', $date)->delete();
        if ($a == true) {
            return "SuccessFully";
        }else{
            return "not";
        }
    }
}
