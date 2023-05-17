<x-app-layout>
    <div class="produits">
        <form method="POST" action="{{route('produits.update', $produit)}}" enctype="multipart/form-data">
        	@method('PUT')
        	@csrf
        	<div class="nom">
	        	<label for="nom">nom: </label>
	        	<input type="text" value="{{$produit->name}}" id="nom" name="name"/>
        	</div>
        	<div class="image">
	        	<label for="image">image: </label>
	        	<input type="file" id="image" name="image"/>
        	</div>
        	<div class="description">
	        	<label for="description">description: </label>
	        	<textarea id="description" name="description">{{$produit->description}}</textarea>
        	</div>
        	<div class="poid">
	        	<label for="poid">poid: </label>
	        	<input type="number" id="poid" name="poid" value="{{$produit->poid}}"/>
        	</div>
        	<div class="price">
	        	<label for="price">price: </label>
	        	<input type="number" id="price" name="price" value="{{$produit->price}}"/>
        	</div>
        	<input type="submit" value="valider">
        </form>
    </div>
</x-app-layout>