<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Livewire\Attributes\Validate;

class UserForm extends Form
{
    #[Validate('required|min:2|max:30')]
    public string $name = '';
    #[Validate('required|email|max:30|unique:users,email')]
    public string $email = '';
    #[Validate('required|min:6')]
    public string $password = '';

    public function saveUser()
    {
        $validated = $this->validate();

        $user = User::create($validated);
        $this->reset();                                 //очистка всех свойств
        session()->flash('success', 'User created successfully'); //записывае сообщение в сессию. Во вьюхе нужно достать
        return $user;
    }
}
