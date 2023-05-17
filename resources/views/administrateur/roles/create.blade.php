<x-app-layout>
    <div class="roles">
        <form action="{{route('roles.store')}}" method="POST">
            @csrf
            name<input type="text" name="name">
            <input type="submit" name="Valider">
        </form>
    </div>
</x-app-layout>