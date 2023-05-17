<x-app-layout>
    <div>
        <form method="POST" action="{{route('challenger.updatecommenter' ,[$produit, $advice->id])}}">
            @method('PUT')
            @csrf
            comment
            <textarea name="comment">{{$advice->comment}}</textarea>
            note
            <input type="number" value="{{$advice->note}}"  value="{{$advice->note}}"  name="note"/>
            <input type="submit" value="commenter">
        </form>
    </div>
</x-app-layout>