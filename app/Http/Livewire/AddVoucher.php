<?php

namespace App\Http\Livewire;

use App\Models\CashReport;
use App\Models\GlCode;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class AddVoucher extends Component
{
    public $code, $editMode, $state, $type, $reportId, $reference_no, $voucher_no;

    protected $rules = [
        'reference_no' => 'required',
        'voucher_no' => 'required|unique:cash_reports,voucher_no',
    ];

    public function edit(CashReport $report)
    {
        $code = GlCode::find($report->gl_code_id);
        $this->editMode = true;
        $this->state['invoice_date'] = $report->invoice_date->format('Y-m-d');
        $this->state['gl_code_id'] = $code->account_code;
        $this->state['job_no'] = $report->job_no;
        $this->state['description'] = $report->description;
        $this->state['type'] = $report->type;
        $this->state['sar'] = $report->sar;
        $this->type = $report->type;
        $this->reportId = $report->id;
    }

    public function update($reportId)
    {
        Validator::make(
            $this->state,
            [
                'invoice_date' => 'required',
                'job_no' => 'required',
                'type' => 'required',
                'sar' => 'required',
                'dollar' => 'nullable',
                'gl_code_id' => 'required|exists:gl_codes,account_code',
                'description' => 'required',
                ])->validate();

                $dollar = $this->state['sar'] / 3.75;
                $code = GlCode::whereaccount_code($this->state['gl_code_id'])->first();
                $this->state['gl_code_id'] = $code->id;
                $this->state['dollar'] = number_format($dollar, 2);
                $report = CashReport::find($reportId);
                $report->update($this->state);
                session()->flash('message', 'Success, Data was updated successfully.');
                $this->editMode = false;
            }

            public function delete($reportId)
            {
                $report = CashReport::find($reportId);
                $report->delete();
                session()->flash('message', 'Success, Data was deleted successfully.');
            }

            public function pay($code)
            {
                $this->validate();

                $vouchers = CashReport::wherebatch_code($code)->get();
                DB::beginTransaction();
                if($vouchers){
                    foreach($vouchers as $voucher){
                        $voucher->update([
                            'ref_no' => $this->reference_no,
                            'voucher_no' => $this->voucher_no,
                            'approval_status' => 1,
                        ]);
                    }
                    DB::commit();
                    session()->flash('message', 'Success, Voucher No.: ' .$this->voucher_no .' was sent for approval.');
                    return redirect()->route('cash-report');
                }else{
                    DB::rollBack();
                    return redirect()->back();
                }
            }

            public function mount($code)
            {
                $ref = CashReport::whereNotNull('ref_no')->pluck('ref_no')->last();
                $v = CashReport::whereNotNull('voucher_no')->pluck('voucher_no')->last();
                if($ref && $v){
                    $vo = substr($v, 0, -4);
                    $v = substr($v, 10) + 1;
                    $number = sprintf('%04d',$v);

                    $this->voucher_no = $vo .$number;
                    $this->reference_no = $ref;
                }
                $this->code = $code;
                $this->editMode = false;
            }

            public function cancel()
            {
                $this->editMode = false;
            }

            public function render()
            {
                $reports = CashReport::wherebatch_code($this->code)->get();

                return view('livewire.add-voucher', compact('reports'))->extends('layouts.master');
            }
        }
