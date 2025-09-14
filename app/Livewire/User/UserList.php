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

    #[Url]
    public string $search = '';

    public function changeLimit()
    {
        $this->limit = in_array($this->limit, $this->limitList) ? $this->limit : $this->limitList[0];
        $this->resetPage();
    }

    public function getLimit(): int
    {
        return in_array($this->limit, $this->limitList) ? $this->limit : $this->limitList[0];
    }

    public function updating($property, $value)
    {
        if($property == 'search'){
            $this->resetPage();
        };
    }

    public function delete(int $id)
    {
        User::find($id)->delete();
    }


    #[On('user-created')]
    public function updateUserList($user = null) {}

    public function render()
    {
        // $users = User::query()
        //     ->with('country')
        //     ->when($this->search, function($query) {
        //         $query->whereLike('name', '%' . $this->search . '%')
        //         ->orWhereLike('email', '%' . $this->search . '%');
        //     })
        //     ->orderBy('id', 'desc')
        //     ->paginate($this->getLimit());

            $users = User::query()
            ->select('users.id', 'users.name', 'users.email', 'countries.name as country_name')
            ->join('countries', 'users.country_id', '=', 'countries.id')
            ->when($this->search, function($query) {
                $query->whereAny(['users.name', 'users.email', 'countries.name'], 
                                  'like', '%' . $this->search . '%');

                // $query->whereLike('users.name', '%' . $this->search . '%')
                // ->orWhereLike('users.email', '%' . $this->search . '%')
                // ->orWhereLike('countries.name', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate($this->getLimit());

        return view('livewire.user.user-list', [
            'users' => $users,
        ]);
    }
}
