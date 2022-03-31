<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UsersList extends Component
{
    public $state, $userId, $role;
    public $pwUpdate = false;
    public $t = 'updatePassword';

    public function edit(User $user)
    {
        $this->dispatchBrowserEvent('show-edit-user-form');
        $this->userId = $user->id;
        $this->role = $user->role_id;
        $this->state['name'] = $user->name;
        $this->state['username'] = $user->username;
        $this->state['email'] = $user->email;
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->clearInput();
    }

    public function clearInput()
    {
        $this->state = null;
    }

    public function submitUser($userId)
    {
        Validator::make(
            $this->state,
            [
                'username' => 'required',
                'role_id' => 'nullable',
                'password' => 'nullable|min:6|confirmed',
                'email' => 'required|email|unique:users,email,' .$userId,
                ])->validate();
                $user = User::find($userId);
                DB::beginTransaction();
                if($user){
                    if($this->pwUpdate){
                        $user->update([
                            'username' => $this->state['username'],
                            'email' => $this->state['email'],
                            'password' => $this->state['password'],
                            'role_id' => $this->state['role_id'] ?? $user->role_id,
                        ]);
                    }else{
                        $user->update([
                            'username' => $this->state['username'],
                            'email' => $this->state['email'],
                            'role_id' => $this->state['role_id'] ?? $user->role_id,
                        ]);
                    }
                    DB::commit();
                    session()->flash('message', 'Success, ' .$user->name .' was updated successfully.');
                    $this->clearInput();
                    $this->dispatchBrowserEvent('hide-form');
                }else{
                    DB::rollBack();
                    return redirect()->back();
                }
            }

            public function render()
            {
                $users = User::where('id', '!=', auth()->id())->latest()->get();

                return view('livewire.users-list', compact('users'))->extends('layouts.master');
            }
        }
