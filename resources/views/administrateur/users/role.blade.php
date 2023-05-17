<x-app-layout>
    <div class="roles">
        <img src="{{asset('/storage/avatars/'.$user->avatar)}}" width="150px" /> 
        {{$user->name}} - {{$user->email}}
        <hr/>
        <h1>Role</h1>
        @if($user->roles)
            @foreach($user->roles as $user_role)
                <form method="POST" action="{{route('users.roles.remove', [$user->id , $user_role->id])}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="{{$user_role->name}}">
                    </form>
            @endforeach
        @endif
        <form action="{{route('users.roles', $user->id)}}" method="POST">
            @csrf
            <select name="role">
                @foreach($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            <input type="submit" name="Valider">
        </form>
        <hr/>
        <h1>Permission</h1>
        <!-- debut methode 1 -->
        @foreach($user->roles as $u_r)
            @foreach($u_r->permissions as $p)
                {{$p->name}}<br/>
            @endforeach
        @endforeach
        @foreach($user->permissions as $u_p)
            <form method="POST" action="{{route('users.permissions.revoke', [$user->id , $u_p->id])}}">
                @method('DELETE')
                @csrf
                <input type="submit" value="{{$u_p->name}}">
             </form>
        @endforeach
        <!-- fin methode 1 -->
        <hr/>
        <hr/>
        <hr/>
        <hr/>
        <hr/>
        <!--debut  methode 2 -->
        @php
            $permissionsAll = collect([]);
            foreach ($user->roles as $role) {
                $permissionsAll = $permissionsAll->merge($role->permissions);
            }
            $permissionsAll = $permissionsAll->merge($user->permissions);
        @endphp
        <ul>
            @foreach ($permissionsAll as $permissionOne)
                <form method="POST" action="{{route('users.permissions.revoke', [$user->id , $permissionOne->id])}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="{{ $permissionOne->name }}">
                     </form>
            @endforeach
        </ul>
        <!-- fin methode 2 -->


        <form action="{{route('users.permissions', $user->id)}}" method="POST">
            @csrf
            <select name="permission">
                @foreach($permissions as $permission)
                    <option value="{{$permission->name}}">{{$permission->name}}</option>
                @endforeach
            <input type="submit" name="Valider">
        </form>
    </div>
</x-app-layout>