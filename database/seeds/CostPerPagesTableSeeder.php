<?php

use Illuminate\Database\Seeder;
use App\CostPerPage;

class CostPerPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CostPerPage::create([
            'writerPageCPP'=> '5.00',
            'writerPowerpointCPP'=> '4.00',
            'writerUrgentPageCPP'=> '6.00',
            'writerUrgentPPTCPP'=> '5.00',
            'editorPageCPP'=> '1.00',
            'editorPowerpointCPP'=> '1.00',
            'expensesPageCPP'=> '1.00',
            'expensesPowerpointCPP'=> '1.00',
        ]);

    }
}
