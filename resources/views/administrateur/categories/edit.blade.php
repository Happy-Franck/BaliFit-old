<x-app-layout>
    <div class="categories">
        <form method="POST" action="{{route('categories.update', $category)}}" enctype="multipart/form-data">
        	@method('PUT')
        	@csrf
        	<div class="nom">
	        	<label for="nom">nom: </label>
	        	<input type="text" value="{{$category->name}}" id="nom" name="name"/>
        	</div>
        	<div class="image">
	        	<label for="image">image: </label>
	        	<input type="file" id="image" name="image"/>
        	</div>
        	<input type="submit" value="valider">
        </form>
    </div>
</x-app-layout>