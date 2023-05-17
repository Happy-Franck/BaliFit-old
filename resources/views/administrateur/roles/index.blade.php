<x-app-layout>
    <div class="Roles">
        <h1>Roles:</h1>
        <a href="{{route('roles.create')}}">Ajouter</a>
        <ul>
            @foreach($roles as $role)
                <li>
                    {{$role->name}} ----->
                    <a href="{{route('roles.edit', $role)}}">editer</a>
                    <form method="POST" action="{{route('roles.destroy', $role)}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="supprimer">
                    </form>
                </li>
            @endforeach
        </ul>    </div>
</x-app-layout>