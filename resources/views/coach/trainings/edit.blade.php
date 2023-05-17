<x-app-layout>
    <div class="training">
        <form method="POST" action="{{route('coach.trainings.update', $training)}}" enctype="multipart/form-data">
        	@method('PUT')
        	@csrf
        	<div class="nom">
	        	<label for="nom">nom: </label>
	        	<input type="text" id="nom" name="name" value="{{$training->name}}"/>
        	</div>
        	<div class="description">
	        	<label for="description">description: </label>
	        	<textarea id="description" name="description">{{$training->description}}</textarea>
        	</div>
        	<div class="image">
	        	<label for="image">image: </label>
	        	<input type="file" id="image" name="image"/>
        	</div>
        	<div class="video">
	        	<label for="video">video: </label>
	        	<input type="file" id="video" name="video"/>
        	</div>
        	<div class="category">
	        	<label for="categorie">categorie: </label>
                @foreach($categories as $category)
		            <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
    				{{ $training->categories->contains($category->id) ? 'checked' : '' }}
		            >
		            <label for="{{ $category->name }}">{{ $category->name }}</label><br>
		        @endforeach 
        	</div>
        	<input type="submit" value="valider">
        </form>
    </div>
</x-app-layout>