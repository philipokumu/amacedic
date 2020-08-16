<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use Carbon\Carbon;
use App\Events\ApprovedOrderEvent;
use App\Mail\Writer\ApprovedOrderWriterMail;
use Illuminate\Support\Facades\Mail;

class OrderApproveAutomatically extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:approve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Approve order automatically after two weeks';

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
        $qualifiedOrders = Order::where('status','completed')->with('writer')->get();

        foreach ($qualifiedOrders as $qualifiedOrder) {

            $OrderTimeInCompletion = (Carbon::now())->diffInDays(Carbon::parse($qualifiedOrder->completed_at),false);

            if ($OrderTimeInCompletion <= -14) {
                
                event(new ApprovedOrderEvent($qualifiedOrder));
                $this->payAdmins($qualifiedOrder);
                $qualifiedOrder->update(['status'=>'approved','approved_at'=>Carbon::now()]);
            } 
        };
        $this->info('Email sent to relevant user(s)');
    }
}
