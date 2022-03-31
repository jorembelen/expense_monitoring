<?php

namespace App\Http\Livewire;

use App\Models\GlCode;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class CodeLists extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $query, $account_code, $business_unit, $account_description, $editMode, $deleteMode, $codeId;

    protected array $rules = [];

    public function rules()
    {
        return [
            'account_code' => 'required|unique:gl_codes,account_code,' .$this->codeId,
            'business_unit' => 'required',
            'account_description' => 'required',
        ];
    }

    public function mount()
    {
        $this->editMode = false;
        $this->deleteMode = false;
        $this->rules = $this->rules();
    }

    public function render()
    {
        $codes = GlCode::search($this->query)->latest()->paginate(10);

        return view('livewire.code-lists', compact('codes'))->extends('layouts.master');
    }

    public function add()
    {
          $this->dispatchBrowserEvent('show-addCode-form');
    }

    public function addCode()
    {
        $validatedData = $this->validate();

        $code = new GlCode();
        DB::beginTransaction();
        if($code){
            $code->create($validatedData);
            DB::commit();
            session()->flash('message', 'Success, ' .$this->account_code .' was added successfully.');
            $this->clearInput();
            $this->dispatchBrowserEvent('hide-form');
        }else{
            DB::rollBack();
            return redirect()->back();
       }
    }

    public function delete(GlCode $code)
    {
        $this->dispatchBrowserEvent('show-deleteCode-form');
        $this->account_code = $code->account_code;
        $this->codeId = $code->id;
        $this->deleteMode = true;
    }

    public function deleteCode()
    {
        $code = GlCode::find($this->codeId);
        $code->delete();
        session()->flash('message', 'Success, ' .$code->account_code .' was deleted successfully.');
        $this->dispatchBrowserEvent('hide-form');
    }

    public function clearInput()
    {
        $this->account_code = null;
        $this->business_unit = null;
        $this->account_description = null;
    }

    public function edit(GlCode $code)
    {
        $this->dispatchBrowserEvent('show-editCode-form');
        $this->editMode = true;
        $this->codeId = $code->id;
        $this->account_code = $code->account_code;
        $this->business_unit = $code->business_unit;
        $this->account_description = $code->account_description;
    }

    public function update()
    {
        $validatedData = $this->validate();
        $code = GlCode::find($this->codeId);
        $code->update($validatedData);
          session()->flash('message', 'Success, ' .$this->account_code .' was updated successfully.');
          $this->clearInput();
          $this->dispatchBrowserEvent('hide-form');
    }

    public function close()
    {
          $this->dispatchBrowserEvent('hide-form');
          $this->clearInput();
    }

}
