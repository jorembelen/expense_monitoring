<?php

namespace App\Http\Livewire;

use App\Models\GlCode;
use Livewire\Component;

class CashReportCreate extends Component
{
    public $inputs = [];
    public $invoice_date, $gl_code_id, $job_no, $description, $type, $sar;
    public $i = 1;

    public function add($i)

    {
        $b = $i + 1;

        $this->i = $b;

        array_push($this->inputs ,$b);
    }

    public function mount()
    {
        $i = 1;

        $this->i = $i;

        array_push($this->inputs ,$i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }


    public function render()
    {
        if(auth()->user()->role_id == 1) {
            $codes = GlCode::latest()->get();
        }else{
            $codes = GlCode::whereaccess(2)->latest()->get();
        }

        return view('livewire.cash-report-create', compact('codes'));
    }
}
