<?php

namespace App\Livewire\User;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\UserForm;

class UserCreate extends Component
{
    use WithFileUploads;
    
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
        $user = $this->form->saveUser();
        $this->dispatch('user-created', $user);
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
    public function render()
    {
        // dump($this->form->country_id);
        return view('livewire.user.user-create', [
            'countries' => Country::all(),
        ]);
    }
}
