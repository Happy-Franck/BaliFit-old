<x-app-layout>
    <div class="roles">
        <img src="{{asset('/storage/avatars/'.$user->avatar)}}" width="150px" /> 
        {{$user->name}} - {{$user->email}}

        <form method="POST" action="{{ route('users.updateCoaches', $user->id) }}">
            @csrf

            <!-- Liste des coachs déjà assignés -->
            <div>
                <label>Coaches actuels:</label>
                @foreach ($user->coaches as $coach)
                    <div>
                        <span>{{ $coach->name }}</span>
                        <button type="submit" name="remove_coach" value="{{ $coach->id }}">Supprimer</button>
                    </div>
                @endforeach
            </div>

            <!-- Liste des nouveaux coachs à assigner -->
            <div>
                <label>Nouveaux coachs:</label>
                <select name="new_coaches[]" multiple>
                    @foreach ($coaches->whereNotIn('id', $user->coaches->pluck('id')->toArray()) as $coach)
                        <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Mettre à jour les coachs</button>
        </form>
    </div>
</x-app-layout>