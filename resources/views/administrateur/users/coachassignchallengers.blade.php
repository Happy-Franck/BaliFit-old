<x-app-layout>
    <div class="roles">
        <img src="{{asset('/storage/avatars/'.$user->avatar)}}" width="150px" /> 
        {{$user->name}} - {{$user->email}}

        <form method="POST" action="{{ route('users.updateChallengers', $user->id) }}">
            @csrf

            <!-- Liste des challenger déjà assignés -->
            <div>
                <label>Challengers actuels:</label>
                @foreach ($user->coachedChallengers as $challenger)
                    <div>
                        <span>{{ $challenger->name }}</span>
                        <button type="submit" name="remove_challenger" value="{{ $challenger->id }}">Supprimer</button>
                    </div>
                @endforeach
            </div>

            <!-- Liste des nouveaux challengers à assigner -->
            <div>
                <label>Nouveaux challengers:</label>
                <select name="new_challengers[]" multiple>
                    @foreach ($challengers->whereNotIn('id', $user->coachedChallengers->pluck('id')->toArray()) as $challenger)
                        <option value="{{ $challenger->id }}">{{ $challenger->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Mettre à jour les challengers</button>
        </form>
    </div>
</x-app-layout>