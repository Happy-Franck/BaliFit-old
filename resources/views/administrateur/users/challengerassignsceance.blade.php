<x-app-layout>
    <div class="roles">
        <img src="{{asset('/storage/avatars/'.$user->avatar)}}" width="150px" /> 
        {{$user->name}} - {{$user->email}}

        <form method="POST" action="{{ route('users.assignSceanceChallengerCoach', $user->id) }}">
            @csrf

            <!-- Liste des nouveaux coachs à assigner -->
            <div>
                <label>Coach:</label>
                <select name="coach_id" multiple>
                    @foreach ($coaches as $coach)
                        <option value="{{ $coach->id }}">{{ $coach->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit">Assigner le coach au challenger pour la sceance</button>
        </form>
    </div>
</x-app-layout>