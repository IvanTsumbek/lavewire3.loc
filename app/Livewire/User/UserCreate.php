<?php

namespace App\Livewire\User;

use App\Models\City;
use App\Models\Street;
use App\Models\Country;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Livewire\Forms\UserForm;

#[Layout('components.layouts.main')]
#[Title('User Create')]
class UserCreate extends Component
{
    use WithFileUploads;

    public UserForm $form;
    public $countries = [];
    public $cities = [];
    public $streets = [];

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function updatedFormCountryId()
    {
        if ($this->form->country_id) {
            $this->cities = City::query()->where('country_id', '=', $this->form->country_id)->get();
        } else {
            $this->cities = [];
        }
        $this->streets = [];
        $this->form->city_id;
        $this->form->street_id;
    }

    public function updatedFormCityId()
    {
        if ($this->form->city_id) {
            $this->streets = Street::query()->where('city_id', '=', $this->form->city_id)->get();
        } else {
            $this->streets = [];
        }
        $this->form->street_id;
    }

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
        // $this->redirect('/', navigate: true);
        $this->redirectRoute('home', navigate: true);
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
        return view('livewire.user.user-create');
    }
}
