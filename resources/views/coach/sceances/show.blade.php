<x-app-layout>
    <div class="sceances">
        <h4>{{$sceance->created_at}}</h4>
            <br/>
        @foreach ($sceance->trainings as $training) 
            <p>{{$training->name}}</p>
            <p>{{$training->pivot->series}} x</p>
            <p>{{$training->pivot->repetitions}} rep</p>
            <p>{{$training->pivot->duree}} s</p>
            <br/>
        @endforeach
    </div>
</x-app-layout>

        