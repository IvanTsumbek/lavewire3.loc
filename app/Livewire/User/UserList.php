<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Forms\UserForm;
use Livewire\Attributes\Validate;

class UserList extends Component
{
    public UserForm $form;

    // protected function rules(): array
    // {
    //     return [
    //                 'name' => 'required|min:2|max:30',
    //                 'email' => 'required|email|max:30|unique',
    //                 'password' => 'required|min:6',
    //             ];
    // }

    // protected function messages():array
    // {
    //     return [
    //         'name.required' => 'Name is required!!!',
    //     ];
    // }

    public function save()
    {
        $this->form->saveUser();
        // $this->all();                             собирает все данные в массив
        // $this->only(['name', 'password']);        собирает выбранные
        // $this->pull(['name', 'password']);        only + reset
    //    $validated = $this->validate([
    //         'name' => 'required|min:2|max:30',
    //         'email' => 'required|email|max:30',
    //         'password' => 'required|min:6',
    //     ]);
        // $validated = $this->validate();
        // User::create($validated);

        // $this->reset();                                 //очистка всех свойств
        // session()->flash('success', 'User created successfully');
        // $this->reset('name', 'email', 'password');   очистка выбраных свойств
    }

    public function delete(int $id)
    {
        User::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.user.user-list', [
            'users' => User::all(),
        ]);
    }
}
