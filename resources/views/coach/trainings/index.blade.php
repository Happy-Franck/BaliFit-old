<x-app-layout>
    <div class="trainings">
        <a href="{{route('coach.trainings.create')}}">Créer</a>
        <ul>
            @foreach ($trainings as $training)
                <li>
                    <a href="{{route('coach.trainings.show', $training)}}">
                        <h2>{{$training->name}}</h2>
                        <img src="{{asset('/storage/trainings/'.$training->image)}}"/>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
