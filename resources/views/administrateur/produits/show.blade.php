<x-app-layout>
    <div class="produits">
        <div class="produit">
            <img src="{{asset('/storage/produits/'.$produit->image)}}"/>
            <h4>Name: {{$produit->name}}</h4>
            <p>description: {{$produit->description}}</p>
            <p>poid: {{$produit->poid}}</p>
            <p>poid: {{$produit->price}}</p>
            @if($note)
                <p>note: {{$note}}</p>
            @endif
        </div>
        <a href="{{route('produits.edit', $produit)}}">Editer</a>
        <div>
        	<form method="POST" action="{{route('produits.destroy' ,$produit)}}">
        		@method("DELETE")
        		@csrf
        		<input type="submit" value="supprimer">
        	</form>
        </div>
        <div>
            @if($produit->advices())
                <p>il y a des avis {{$produit->getAverageRatingAttribute()}}/5</p>
            @else
                <p>il n'y a pas d'avis</p>
            @endif
        </div>
        <hr/>
        <hr/>
        <hr/>
        @foreach ($produit->advices as $avis)
            @ {{ $avis->user->name }}
            <br/>
            {{ $avis->comment }} ---> {{ $avis->note }} / 5
            <hr/>
        @endforeach
    </div>
</x-app-layout>