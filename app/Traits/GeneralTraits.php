<?php

namespace App\Traits;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use App\Message;
use App\Admin;
use App\AdminCoin;
use App\RevisionInstruction;

trait GeneralTraits
{

    public function setDeadline($order) {

        $deadline = Carbon::now()->diffAsCarbonInterval(Carbon::parse($order->endDate),false);
        $writerDeadline = Carbon::now()->diffAsCarbonInterval(Carbon::parse($order->writerEndDate),false);

        $deadlines = [$deadline, $writerDeadline];
        return $deadlines;
    }

    public function showRevisions($order) {
    
        return RevisionInstruction::where(['order_id'=>$order->id])
            ->select('revisionInstructions','messageSender')->get();
    }

    /* Amount to be paid to editor, writer, expenses and balance */
    private function payAmount(){
        if (substr(request()->currency,5) == 'GBP') {
            $payAmount = (floatval(request()->totalPrice) * 1/floatval(substr(request()->currency,0,4)) * 100);
        }

        else if (substr(request()->currency,5) == 'EUR') {
            $payAmount = (floatval(request()->totalPrice) * 1/floatval(substr(request()->currency,0,4)) * 100);
        }

        else if (substr(request()->currency,5) == 'AUD') {
            $payAmount = (floatval(request()->totalPrice) * 1/floatval(substr(request()->currency,0,4)) * 100);
        }
        else {
            $payAmount = (floatval(request()->totalPrice) * 100);
        }

        return $payAmount;

    }

    /* Writer's deadline and full deadline*/
    private function deadlines($deadline){

        if (substr($deadline,8)== 'days'||substr($deadline,7)== 'days') {
            
            $urgency = intval(round(substr($deadline,5)));
            $writerUrgency = intval(round(0.75 * $urgency));
            $writerMaximumUrgency = intval(round(0.90 * $urgency));
            $deadline = CarbonInterval::days($urgency)->cascade()->forHumans();
            $writerDeadline = CarbonInterval::days($writerUrgency)->cascade()->forHumans();
            $writerMaximumDeadline = CarbonInterval::days($writerMaximumUrgency)->cascade()->forHumans();
            
            $endDate = Carbon::now()->add($deadline);
            $writerEndDate = Carbon::now()->add($writerDeadline);
            $writerMaximumExtensionDate = Carbon::now()->add($writerMaximumDeadline);

            $deadlines = [$deadline, $endDate, $writerEndDate, $writerMaximumExtensionDate];

            return $deadlines;

        }
        
        else if (substr($deadline,7)== 'hours'|| substr($deadline,8)== 'hours') {

            $urgency = intval(round(substr($deadline,5)));
            $writerUrgency = intval(round(0.75 * $urgency));
            $writerMaximumUrgency = intval(round(0.90 * $urgency));
            $deadline = CarbonInterval::hours($urgency)->cascade()->forHumans();
            $writerDeadline = CarbonInterval::hours($writerUrgency)->cascade()->forHumans();
            $writerMaximumDeadline = CarbonInterval::hours($writerMaximumUrgency)->cascade()->forHumans();

            $endDate = Carbon::now()->add($deadline);
            $writerEndDate = Carbon::now()->add($writerDeadline);
            $writerMaximumExtensionDate = Carbon::now()->add($writerMaximumDeadline);

            $deadlines = [$deadline, $endDate, $writerEndDate, $writerMaximumExtensionDate];

            return $deadlines;

        } else if (request()->has('revisionDuration')) {

            $urgency = intval($deadline);
            $writerUrgency = intval(round(0.75 * $urgency));
            $writerMaximumUrgency = intval(round(0.90 * $urgency));
            $deadline = CarbonInterval::hours($urgency)->cascade()->forHumans();
            $writerDeadline = CarbonInterval::hours($writerUrgency)->cascade()->forHumans();
            $writerMaximumDeadline = CarbonInterval::hours($writerMaximumUrgency)->cascade()->forHumans();

            $endDate = Carbon::now()->add($deadline);
            $writerEndDate = Carbon::now()->add($writerDeadline);
            $writerMaximumExtensionDate = Carbon::now()->add($writerMaximumDeadline);

            $deadlines = [$endDate, $writerEndDate, $writerMaximumExtensionDate];

            return $deadlines;

        }
    }

    // Happens either when an order is automatically or manually approved by client 
    public function payAdmins($order) {

        $admins = Admin::pluck('id')->toArray();

        $countAdmin = count($admins);

        $adminAmount = floor(($order->balance)/$countAdmin);

        foreach ($admins as $admin) {
            AdminCoin::create([
                'admin_id'=>$admin,
                'order_id'=>$order->id,
                'amount'=>$adminAmount,
            ]);
        }
    }
}

