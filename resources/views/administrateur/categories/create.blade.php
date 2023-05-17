<x-app-layout>
    <div class="categories">
        <form method="POST" action="{{route('categories.store')}}" enctype="multipart/form-data">
        	@csrf
        	<div class="nom">
	        	<label for="nom">nom: </label>
	        	<input type="text" id="nom" name="name"/>
        	</div>
        	<div class="image">
	        	<label for="image">image: </label>
	        	<input type="file" id="image" name="image"/>
        	</div>
        	<input type="submit" value="valider">
        </form>
    </div>
</x-app-layout>