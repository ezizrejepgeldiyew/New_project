<?php

namespace App\Console\Commands;

use App\Models\Discount;
use App\Models\product;
use DateTimeZone;
use Illuminate\Console\Command;

class DiscountDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discount:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $datetime = now()->setTimezone($la_time);
        $datetime = $datetime->format('Y-m-d H:i:s');

        $discount = Discount::where('date','<=',$datetime)->pluck('product_id');
        product::where('id',$discount)->update([
            'discount' => null,
        ]);
        $a = (bool)Discount::where('date','<=',$datetime)->delete();
        if ($a == true) {
            return "SuccessFully";
        }else{
            return "not";
        }
    }
}
