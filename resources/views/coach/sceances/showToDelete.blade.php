<x-app-layout>
    <div class="training">
        @foreach ($sceance->trainings as $training)
            {{ $training->pivot->id }}
            {{ $training->name }}
            {{ $training->pivot->series }} x 
            {{ $training->pivot->repetitions }} rep =
            {{ $training->pivot->duree }} s
            <form method="POST" action="{{ route('coach.deleteTraining', [$sceance->id, $training->id, $training->pivot->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
        @endforeach
    </div>
</x-app-layout>