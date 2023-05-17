<x-app-layout>
    <div class="challengers">
        @foreach ($challengers as $challenger)
            <div>
                <span>{{ $challenger->name }}</span>
            </div>
            <hr/>
        @endforeach
    </div>
</x-app-layout>