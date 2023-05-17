<x-app-layout>
    <div class="sceances">
        <!--<a href="{{route('coach.sceances.create')}}">Créer</a>-->
        <ul>
            @foreach ($sceances as $sceance)
                <li>
                    <h2>{{$sceance->created_at}} ({{$sceance->validated}})</h2>
                    <div>
                        <a href="{{route('coach.sceances.show', $sceance)}}">
                            Voir les détails
                        </a>
                    </div>
                    <div>
                        <a href="{{route('coach.showToDelete', $sceance)}}">
                            delete
                        </a>
                    </div>
                    <div>
                        @if($sceance->trainings->count() > 0)
                            <a href="{{route('coach.editTrainings', $sceance)}}">
                                Editer
                            </a>
                        @else
                            <a href="{{route('coach.sceances.edit', $sceance)}}">
                                Create
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>