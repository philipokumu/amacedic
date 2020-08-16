<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CostPerPage extends Model
{
    protected $fillable = ['writerPageCPP','writerPowerpointCPP','writerUrgentPageCPP',
    'writerUrgentPPTCPP','editorPageCPP','editorPowerpointCPP','expensesPageCPP','expensesPowerpointCPP'];
}
