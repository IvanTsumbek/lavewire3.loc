<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;

class UserList extends Component
{
    #[Validate('required')]
    #[Validate('min:2', as:'Имя')]
    #[Validate('max:30', message:'Слишком длинное имя')]
    public string $name;
    #[Validate('required|email|max:30')]
    public string $email;
    #[Validate('required|min:6')]
    public string $password;

    protected function rules(): array
    {
        return [
                    'name' => 'required|min:2|max:30',
                    'email' => 'required|email|max:30',
                    'password' => 'required|min:6',
                ];
    }

    protected function messages():array
    {
        return [
            'name.required' => 'Name is required!!!',
        ];
    }

    public function save()
    {
        // $this->all();                             собирает все данные в массив
        // $this->only(['name', 'password']);        собирает выбранные
        // $this->pull(['name', 'password']);        only + reset
    //    $validated = $this->validate([
    //         'name' => 'required|min:2|max:30',
    //         'email' => 'required|email|max:30',
    //         'password' => 'required|min:6',
    //     ]);
        $validated = $this->validate();
        User::create($validated);

        $this->reset();                                 //очистка всех свойств
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
