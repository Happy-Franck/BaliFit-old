<x-app-layout>
    <div class="permissions">
        <h1>Permissions:</h1>
        <a href="{{route('permissions.create')}}">Ajouter</a>
        <ul>
            @foreach($permissions as $permission)
                <li>
                    {{$permission->name}} ------>
                    <a href="{{route('permissions.edit', $permission)}}">editer</a>
                    <form method="POST" action="{{route('permissions.destroy', $permission)}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="supprimer">
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>