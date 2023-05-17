<x-app-layout>
    <div class="categories">
        <a class="btn btn-primary" href="{{route('categories.create')}}">Créer</a>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <a href="{{route('categories.show', $category)}}">
                        <p>{{$category->name}}</p>
                        <img src="{{asset('/storage/categories/'.$category->image)}}"/> 
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>