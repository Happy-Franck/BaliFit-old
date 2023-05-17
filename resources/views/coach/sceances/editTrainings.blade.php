<x-app-layout>
    <div class="training">
        {{$sceance->created_at}}
        <form id="mon-formulaire" method="POST" action="{{ route('coach.updateTrainings', $sceance->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div id="all-data">
        @foreach ($sceance->trainings as $training)
            <div class="list-input">
                <div class="trainingslist">
                    <select name="traininglist[]">
                        @foreach ($trainings as $tr)
                            <option value="{{ $tr->id }}" {{ $training->id === $tr->id ? 'selected' : '' }}>{{ $tr->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="serietraining">
                    <input type="number" name="series[]" class="series" value="{{ $training->pivot->series }}">
                </div>
                <div class="reptraining">
                    <input type="number" name="repetitions[]" class="repetitions" value="{{ $training->pivot->repetitions }}">
                </div>
                <div class="dureetraining">
                    <input type="number" name="duree[]" class="duree" value="{{ $training->pivot->duree }}">
                </div>
            </div>
        @endforeach
    </div>
    <button type="submit">Envoyer</button>
</form>

    </div>
</x-app-layout>