<x-app-layout>
    <div class="roles">
        <form action="{{route('roles.update', $role)}}" method="POST">
            @method('PUT')
            @csrf
            name<input type="text" name="name" value="{{$role->name}}">
            <input type="submit" name="Valider">
        </form>

        <hr/>
        @if($role->permissions)
            @foreach($role->permissions as $role_permision)
                <form method="POST" action="{{route('roles.permissions.revoke', [$role->id , $role_permision->id])}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="{{$role_permision->name}}">
                    </form>
            @endforeach
        @endif
        <form action="{{route('roles.permissions', $role->id)}}" method="POST">
            @csrf
            <select name="permission">
                @foreach($permissions as $permission)
                    <option value="{{$permission->name}}">{{$permission->name}}</option>
                @endforeach
            <input type="submit" name="Valider">
        </form>
    </div>
</x-app-layout>