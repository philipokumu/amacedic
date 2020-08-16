<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use Carbon\Carbon;

class OrderIsLate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:late';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deduct writer amount for late submission';

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
     * @return mixed
     */
    public function handle()
    {
        $qualifiedOrders = Order::whereIn('status',['inprogress','inrevision','assigned'])->with('writer')->get();

        foreach ($qualifiedOrders as $qualifiedOrder) {

            $intervalSign = (Carbon::now())->diffAsCarbonInterval(Carbon::parse($qualifiedOrder->writerEndDate),false)->invert ? 'minus' : 'plus';

            if ($intervalSign == 'minus') {

                $writerAmount = intval($qualifiedOrder->writerAmount - 1);

                if ($writerAmount > 0) {
                    
                    $qualifiedOrder->update(['writerAmount'=>$writerAmount]);
                }

            }
                
        };
        $this->info('Writer(s) amount deducted');
    }
}
