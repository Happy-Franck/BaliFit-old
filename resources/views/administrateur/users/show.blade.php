<x-app-layout>
    <div class="users">
        {{$user->name}} 
        <img src="{{asset('/storage/avatars/'.$user->avatar)}}" width="150px" /> {{$user->email}}
        <hr/>
        @foreach($user->roles as $user_role)
            {{$user_role->name}}
        @endforeach
        <hr/>
        @foreach($user->permissions as $user_permission)
            {{$user_permission->name}}
        @endforeach
    </div>
</x-app-layout>