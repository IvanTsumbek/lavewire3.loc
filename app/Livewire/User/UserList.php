<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Home Page')]
class UserList extends Component
{
    use WithPagination;

        public function delete(int $id)
    {
        User::find($id)->delete();
    }

    #[On('user-created')]
    public function updateUserList($user=null)
    {

    }

    public function render()
    {
        return view('livewire.user.user-list', [
            'users' => User::query()->with('country')->orderBy('id', 'desc')->paginate(10),
        ]);
    }
}
