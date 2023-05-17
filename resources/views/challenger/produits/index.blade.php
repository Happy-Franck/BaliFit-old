<x-app-layout>
    <div class="produits">
        <ul>
            @foreach ($produits as $produit)
                <li>
                    <a href="{{route('challenger.showProduct', $produit)}}">
                        <h2>{{$produit->name}}</h2>
                        <img src="{{asset('/storage/produits/'.$produit->image)}}"/>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
