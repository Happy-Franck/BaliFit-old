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
        <div>
            @if($produit->advices())
                <p>il y a des avis {{$produit->getAverageRatingAttribute()}}/5</p>
            @else
                <p>il n'y a pas d'avis</p>
            @endif
        </div>
        <div>
            @foreach ($produit->advices as $avis)
                @if($avis->user_id == $user_co->id)
                    @php
                        $commented = true
                    @endphp
                    @break
                @endif
            @endforeach
            @if($commented == false)
                <form method="POST" action="{{route('challenger.commenter' ,$produit)}}">
                    @csrf
                    comment
                    <textarea name="comment"></textarea>
                    note
                    <input type="number" name="note"/>
                    <input type="submit" value="commenter">
                </form>
            @endif
        </div>
        <hr/>
        @foreach ($produit->advices as $avis)
            {{ $avis->comment }}
            {{ $avis->note }}
            @if($avis->user_id == $user_co->id)
                -------->
                <form method="POST" action="{{route('challenger.supprcommenter', [$produit->id, $avis->id])}}">
                    @method("DELETE")
                    @csrf
                    <input type="submit" value="supprimer">
                </form>
                <a href="{{route('challenger.editcommenter', [$produit->id, $avis->id])}}">editer</a>
            @endif
            <hr/>
        @endforeach
    </div>
</x-app-layout>