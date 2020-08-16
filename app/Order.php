<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
        'academicLevel', 'typeOfPaper', 'subjectArea', 'title', 'paperInstructions','citation', 'spacing',
        'powerpointSlides', 'noOfPages', 'sources', 'deadline', 'coupon', 'currency', 'totalPrice', 'user_id',
        'writer_id', 'status', 'editor_id', 'preferredWriter_id', 'rating', 'ratingComment','clientCancelReason',
        'writerAmount', 'editorAmount', 'expensesAmount', 'balance', 'balanceAmountRequested_at',
        'isBalanceRequested', 'expensesAmountRequested_at','editorAmountRequested_at', 'writerAmountRequested_at',
        'unassigned_at', 'completed_at','editorInvoice_id','expensesInvoice_id','writerInvoice_id','discount',
        'discountedTotalPrice','visitor','isRefunded','refunded_at','refundedByAdmin_id','totalPriceInKsh','endDate',
        'writerEndDate','writerMaximumExtensionDate','approved_at','isUrgent','originalWriterAmount'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function bids(){
        return $this->hasMany(Bid::class);
    }

    public function writer(){
        return $this->belongsTo(Writer::class,'writer_id');
    }

    public function editor(){
        return $this->belongsTo(Editor::class);
    }

    public function fileUploads(){
        return $this->hasMany(FileUpload::class);
    }

    public function revisionInstructions(){
        return $this->hasMany(RevisionInstruction::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
    public function adminCoins(){
        return $this->hasMany(AdminCoin::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

}
