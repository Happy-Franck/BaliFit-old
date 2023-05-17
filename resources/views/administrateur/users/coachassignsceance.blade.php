<x-app-layout>
    <div class="roles">
        <h1>Je suis le coach</h1>
        <img src="{{asset('/storage/avatars/'.$user->avatar)}}" width="150px" /> 
        {{$user->name}} - {{$user->email}}

        <form method="POST" action="{{ route('users.assignSceanceCoachChallenger', $user->id) }}">
            @csrf
            <!-- Liste des nouveaux coachs à assigner -->
            <div>
                <label>Challenger à donner au coach:</label>
                <select name="challenger_id">
                    @foreach ($challengers as $challenger)
                        <option value="{{ $challenger->id }}">{{ $challenger->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Assigner le challenger au coach pour la sceance</button>
        </form>
    </div>
</x-app-layout>