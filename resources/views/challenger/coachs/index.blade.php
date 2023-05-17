<x-app-layout>
    <div class="coachs">
        @foreach ($coachs as $coach)
            <div>
                <span>{{ $coach->name }}</span>
            </div>
            <hr/>
        @endforeach
    </div>
</x-app-layout>