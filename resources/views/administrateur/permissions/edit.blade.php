<x-app-layout>
    <div class="permissions">
        <form action="{{route('permissions.update', $permission)}}" method="POST">
            @method('PUT')
            @csrf
            name<input type="text" name="name" value="{{$permission->name}}">
            <input type="submit" name="Valider">
        </form>
        @if($permission->roles)
            @foreach($permission->roles as $permission_role)
                <form method="POST" action="{{route('permissions.roles.remove', [$permission->id , $permission_role->id])}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="{{$permission_role->name}}">
                    </form>
            @endforeach
        @endif
        <form action="{{route('permissions.roles', $permission->id)}}" method="POST">
            @csrf
            <select name="role">
                @foreach($roles as $role)
                    <option value="{{$role->name}}">{{$role->name}}</option>
                @endforeach
            <input type="submit" name="Valider">
        </form>
    </div>
</x-app-layout>