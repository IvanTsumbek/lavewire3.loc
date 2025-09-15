<div class="col-12">

    <div class="d-flex justify-content-between mb-2" id="users-list">
     
        <div>
            <select class="form-select" wire:model="limit" wire:change="changeLimit">
                @foreach ($limitList as $k => $v)
                <option 
                    @if($v == $limit) selected @endif 
                    value="{{ $v }}"
                    wire:key="{{ $k }}"
                    >{{ $v }}
                </option>                    
                @endforeach ()
              </select>

{{-- 
            <select class="form-select" wire:model.live="limit">
                @foreach ($limitList as $k => $v)
                <option 
                    @if($v == $limit) selected @endif 
                    value="{{ $v }}"
                    wire:key="{{ $k }}"
                    >{{ $v }}
                </option>                    
                @endforeach ()
              </select> --}}
        </div>

        <div>
            <input type="text" class="form-control" id="search" placeholder="Search..."
            wire:model.live.debounce.300ms="search">
        </div>

    </div>

    <div class="table-responsive position-relative">

        <div wire:loading
            style="position:absolute; width: 100%; height: 100%; 
                    background: rgba(255, 255, 255, .7);
                    text-align: center; pt: 20px;">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th wire:click="changeOrder('users.id')" style="cursor:pointer;">
                        <x-sort-arrows 
                        fieldName="ID"
                        :orderByField="$orderByField"
                        :orderByDirection="$orderByDirection"
                        :orderByFieldList="$orderByFieldList"/>
                    </th>
                    <th wire:click="changeOrder('users.name')" style="cursor:pointer;">
                        <x-sort-arrows 
                        fieldName="Name"
                        :orderByField="$orderByField"
                        :orderByDirection="$orderByDirection"
                        :orderByFieldList="$orderByFieldList"/>
                    </th>
                    <th wire:click="changeOrder('users.email')" style="cursor:pointer;">
                        <x-sort-arrows 
                        fieldName="Email"
                        :orderByField="$orderByField"
                        :orderByDirection="$orderByDirection"
                        :orderByFieldList="$orderByFieldList"/>
                    </th>
                    <th wire:click="changeOrder('countries.name')" style="cursor:pointer;">
                        <x-sort-arrows 
                        fieldName="Country"
                        :orderByField="$orderByField"
                        :orderByDirection="$orderByDirection"
                        :orderByFieldList="$orderByFieldList"/>
                    </th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr wire:key="{{ $user->id }}">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->country_name }}</td>
                        <td><button wire:click="delete({{ $user->id }})" wire:confirm="Are you sure?"
                                class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links(data: ['scrollTo' => '#users-list']) }}



    {{-- <ul id="users-list">
        @forelse ($users as $user)
            <li wire:key="{{ $user->id }}">{{ $user->name }} ({{ $user->email }}) | 
                {{ $user->country->name }} |
                <a href="#" wire:click.prevent="delete({{ $user->id }})"
                            wire:confirm="Are you sure?">Delete</a>
                @if ($user->avatar)
                    <img src="{{ asset('uploads/' . $user->avatar) }}" alt="" height="50">
                @endif
            </li>
        @empty
            <p>User list is empty...</p>
        @endforelse
    </ul> --}}

</div>
