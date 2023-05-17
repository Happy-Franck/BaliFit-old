<x-app-layout>
    <div class="produits">
        <form method="POST" action="{{route('produits.store')}}" enctype="multipart/form-data">
        	@csrf
        	<div class="nom">
	        	<label for="nom">nom: </label>
	        	<input type="text" id="nom" name="name"/>
        	</div>
        	<div class="image">
	        	<label for="image">image: </label>
	        	<input type="file" id="image" name="image"/>
        	</div>
        	<div class="description">
	        	<label for="description">description: </label>
	        	<textarea id="description" name="description"></textarea>
        	</div>
        	<div class="poid">
	        	<label for="poid">poid: </label>
	        	<input type="number" id="poid" name="poid"/>
        	</div>
        	<div class="price">
	        	<label for="price">price: </label>
	        	<input type="number" id="price" name="price"/>
        	</div>
        	<input type="submit" value="valider">
        </form>
    </div>
</x-app-layout>