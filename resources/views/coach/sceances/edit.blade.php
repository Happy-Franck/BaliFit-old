<x-app-layout>
    <div class="training">
        {{$sceance->created_at}}
        <form id="mon-formulaire" method="POST" action="{{route('coach.addTrainings', $sceance->id)}}" enctype="multipart/form-data">
        	@csrf
        	<div id="all-data">
	            <div class="list-input">
	                <div class="trainingslist">
	                    <select name="traininglist[]">
	                        @foreach ($trainings as $training)
	                            <option value="{{ $training->id }}">{{ $training->name }}</option>
	                        @endforeach
	                    </select>
	                </div>
	                <div class="serietraining">
	                    <input type="number" name="series[]" class="series">
	                </div>
	                <div class="reptraining">
	                    <input type="number" name="repetitions[]" class="repetitions">
	                </div>
	                <div class="dureetraining">
	                    <input type="number" name="duree[]" class="duree">
	                </div>
	            </div>
	        </div>
            <button type="button" onclick="ajouterChamp()">Ajouter un champ</button>
            <button type="submit">Envoyer</button>
        </form>
    </div>
    <script>
        function ajouterChamp() {
            var formulaire = document.getElementById("all-data");
            var listInput = document.querySelector('.list-input:last-of-type');
            var newInputContainer = listInput.cloneNode(true);
            newInputContainer.querySelector('.series').value = '';
            newInputContainer.querySelector('.repetitions').value = '';
            newInputContainer.querySelector('.duree').value = '';
            var btn = newInputContainer.querySelector('.suppr');
            if(btn){
            	btn.remove();
            }
            var deleteButton = document.createElement('button');
		    deleteButton.textContent = 'Supprimer';
		    deleteButton.classList.add('suppr');
		    deleteButton.onclick = function() {
		        supprimerChamp(this);
		    };
		    newInputContainer.appendChild(deleteButton);
            listInput.parentNode.appendChild(newInputContainer);
        }
        function supprimerChamp(button) {
		    var champ = button.parentNode;
		    champ.parentNode.removeChild(champ);
		}
    </script>
</x-app-layout>
