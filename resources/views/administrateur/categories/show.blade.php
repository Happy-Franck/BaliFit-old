<x-app-layout>
    <div class="categories">
        <h4>Name: {{$category->name}}</h4>
        <img src="{{asset('/storage/categories/'.$category->image)}}"/>
    </div>
    <a href="{{route('categories.edit', $category)}}">Editer</a>
    <div>
    	<form method="POST" action="{{route('categories.destroy' ,$category)}}">
    		@method("DELETE")
    		@csrf
    		<input type="submit" value="supprimer">
    	</form>
    </div>
</x-app-layout>