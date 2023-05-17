<x-app-layout>
    <div class="produits">
        <a href="{{route('produits.create')}}">Créer</a>
        <div class="row">
            @foreach ($produits as $produit)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <a href="{{route('produits.show', $produit)}}">
                        <h2>{{$produit->name}}</h2>
                        <img src="{{asset('/storage/produits/'.$produit->image)}}"/>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
