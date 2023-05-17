<x-app-layout>
    <div class="users">
        <h1>users:</h1>
        <ul>
            @foreach($users as $user)
                <li>

                    <img src="{{asset('/storage/avatars/'.$user->avatar)}}" width="50px" /> 
                    <a href="{{route('users.show', $user)}}">{{$user->name}} </a> ----->
                    <a href="{{route('users.edit', $user)}}">editer</a>
                    <form method="POST" action="{{route('users.destroy', $user)}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="supprimer">
                    </form>
                    ----->
                    @if($user->hasRole('coach'))
                        xxx <p>A {{$user->coachedChallengers->count()}} challengers</p>
                        <br/>
                        xxx <a href="{{route('users.updateChallengersForm', $user)}}">Give Challengers (assignChallengers)</a>
                        <br/>
                        xxx <a href="{{route('users.assignSceanceCoachChallengerForm', $user)}}">Coaching Sceance (coacher un Challengers)</a>
                    @endif
                    @if($user->hasRole('challenger'))
                        yyy <p>A {{$user->coaches->count()}} coaches</p>
                        <br/>
                        yyy <a href="{{route('users.updateCoachesForm', $user)}}">Give Coachs (assignCoachs)</a>
                        <br/>
                        xxx <a href="{{route('users.assignSceanceChallengerCoachForm', $user)}}">Challenger Sceance (challenger obtient une sceance avec un coach)</a>
                    @endif
                </li>
                <hr/>
                <hr/>
            @endforeach
        </ul>    
    </div>
</x-app-layout>