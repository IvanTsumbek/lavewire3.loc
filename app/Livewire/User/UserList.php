<?php

namespace App\Livewire\User;

use App\Models\User;
use Illuminate\Support\Arr;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

#[Title('Home Page')]
class UserList extends Component
{
    use WithPagination;

    #[Url]
    public int $limit = 10;

    public array $limitList = [10, 25, 50, 100];

    public function changeLimit($limit)
    {
        $limit = (int) $limit;
        $this->limit = in_array($limit, $this->limitList) ? $limit : $this->limitList[0];
        $this->resetPage();
    }

    public function getLimit(): int
    {
        return in_array($this->limit, $this->limitList) ? $this->limit: 
        $this->limitList[0];
    }

        public function delete(int $id)
    {
        User::find($id)->delete();
    }


    #[On('user-created')]
    public function updateUserList($user=null)
    {}

    public function render()
    {
        return view('livewire.user.user-list', [
            'users' => User::query()
                            ->with('country')
                            ->orderBy('id', 'desc')
                            ->paginate($this->getLimit()),
        ]);
    }
}
