<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeesList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $query, $name, $nationality, $position, $type, $empId, $editMode, $deleteMode;
    public $state;
    protected array $rules = [];

    public function rules()
    {
        return [
            'name' => 'required',
            'nationality' => 'required',
            'position' => 'required',
            'type' => 'required',
        ];
    }

    public function addEmp()
    {
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteEmp(Employee $employee)
    {
        $this->dispatchBrowserEvent('show-delete-form');
        $this->name = $employee->name;
        $this->empId = $employee->id;
        $this->deleteMode = true;
    }

    public function delete()
    {
        $employee = Employee::find($this->empId);
        $employee->delete();
        session()->flash('message', 'Success, ' .$this->name .' was deleted successfully.');
        $this->dispatchBrowserEvent('hide-delete-form');
    }

    public function editEmp(Employee $employee)
    {
        $this->dispatchBrowserEvent('show-edit-form');
        $this->editMode = true;
        $this->empId = $employee->id;
        $this->name = $employee->name;
        $this->job_code = $employee->job_code;
    }

    public function update()
    {
        $validatedData = $this->validate();
        $employee = Employee::find($this->empId);
        $employee->update($validatedData);
        session()->flash('message', 'Success, ' .$this->name .' was updated successfully.');
        $this->clearInput();
        $this->dispatchBrowserEvent('hide-form');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->clearInput();
    }

    public function add()
    {
        $this->validate();

        $emp = new Employee();
        DB::beginTransaction();
        if($emp){
            $emp->create($this->validate());
            DB::commit();
            session()->flash('message', 'Success, ' .$this->name .' was added successfully.');
            $this->clearInput();
            $this->dispatchBrowserEvent('hide-form');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function mount()
    {
        $this->editMode = false;
        $this->deleteMode = false;
        $this->rules = $this->rules();
    }

    public function clearInput()
    {
        $this->name = null;
        $this->job_code = null;
    }

    public function addUser($empId)
    {
        $employee = Employee::find($empId);
        $this->dispatchBrowserEvent('show-user-form');
        $this->state['user-name'] = $employee->name;
        $this->state['user_code'] = $employee->user_code;
        $this->empId = $employee->id;

    }

    public function clearUserInput()
    {
        $this->state = null;
    }

    public function submitUser($empId)
    {
        Validator::make(
            $this->state,
            [
                'username' => 'required',
                'email' => 'required|email',
                ])->validate();

        $employee = Employee::find($empId);
        DB::beginTransaction();
        if($employee){
            User::create([
                'name' => $employee->name,
                'email' => $this->state['email'],
                'username' => $this->state['username'],
                'role_id' => 2,
                'user_code' => $employee->user_code,
                'password' => '123456',
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('hide-form');
            $this->clearUserInput();
            session()->flash('message', 'Success, ' .$employee->name .' was added successfully as user.');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function render()
    {
        $employees = Employee::search($this->query)->latest()->paginate(10);

        return view('livewire.employees-list', compact('employees'))->extends('layouts.master');
    }
}
