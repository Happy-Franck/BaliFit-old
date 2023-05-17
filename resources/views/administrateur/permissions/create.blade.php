<x-app-layout>
    <div class="permissions">
        <form action="{{route('permissions.store')}}" method="POST">
            @csrf
            name<input type="text" name="name">
            <input type="submit" name="Valider">
        </form>
    </div>
</x-app-layout>