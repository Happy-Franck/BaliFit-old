<x-app-layout>
    <div class="trainings">
        <h4>Name: {{$training->name}}</h4>
        <p>description: {{$training->description}}</p>
        <p>categories: 
            @foreach($training->categories as $category)
                {{$category->name}} -
            @endforeach
        </p>
        <img src="{{asset('/storage/trainings/'.$training->image)}}"/>
        <video width="250" height="200" controls>
            <source src="{{asset('/storage/training_videos/'.$training->video)}}" type="video/mp4"/>
        </video>
    </div>
    <a href="{{route('coach.trainings.edit', $training)}}">Editer</a>
    <div>
    	<form method="POST" action="{{route('coach.trainings.destroy' ,$training)}}">
    		@method("DELETE")
    		@csrf
    		<input type="submit" value="supprimer">
    	</form>
    </div>
</x-app-layout>