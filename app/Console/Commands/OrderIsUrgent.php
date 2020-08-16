<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Order;
use Carbon\Carbon;
use App\Mail\Writer\UrgentOrderWriterMail;

class OrderIsUrgent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:urgent';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email if order becomes urgent';

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

            $OrderRemainingTime = (Carbon::now())->diffInHours(Carbon::parse($qualifiedOrder->writerEndDate),false);

            if ($OrderRemainingTime <= 12) {

                $intervalSign = (Carbon::now())->diffAsCarbonInterval(Carbon::parse($qualifiedOrder->writerEndDate),false)->invert ? 'minus' : 'plus';

                if ($intervalSign == 'plus') {

                    $qualifiedOrder->update(['isUrgent'=>'yes']);
                    
                    Mail::to($qualifiedOrder->writer->email)->send(new UrgentOrderWriterMail($qualifiedOrder, $OrderRemainingTime));
                    
                } else {
                    
                    $qualifiedOrder->update(['isUrgent'=>'yes']);

                }
                
            }
            else {

                $qualifiedOrder->update(['isUrgent'=>'no']);
            }
        };
        $this->info('Email sent to writer(s)');
    }
}
