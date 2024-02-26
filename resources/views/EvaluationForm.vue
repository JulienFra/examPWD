<template>
    <div>
        <h1>Formulaire d'évaluation</h1>

        <!-- Formulaire -->
        <form action="/submit" method="POST">
            @csrf

            <!-- Boucle sur chaque question -->
            @foreach ($questions as $question)
            <div>
                <!-- Affichage de la question -->
                <label
                    for="question{{ $question->id }}"
                    >{{ $question->content }}</label
                ><br />

                <!-- Champ de texte pour le commentaire si disponible -->
                @if ($question->have_a_comment)
                <textarea
                    name="comment{{ $question->id }}"
                    id="comment{{ $question->id }}"
                    cols="30"
                    rows="3"
                ></textarea
                ><br />
                @endif

                <!-- Choix multiple -->
                @if ($question->type === 'multiple_choice')
                <!-- Boucle sur chaque option de choix -->
                @foreach ($question->options as $option)
                <input
                    type="radio"
                    id="option{{ $option->id }}"
                    name="question{{ $question->id }}"
                    value="{{ $option->id }}"
                />
                <label
                    for="option{{ $option->id }}"
                    >{{ $option->content }}</label
                ><br />
                @endforeach

                <!-- Champ de texte pour la saisie de réponse -->
                @elseif ($question->type === 'text')
                <input
                    type="text"
                    id="text{{ $question->id }}"
                    name="question{{ $question->id }}"
                /><br />
                @endif
            </div>
            @endforeach

            <!-- Bouton de soumission du formulaire -->
            <button type="submit">Soumettre</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            questions: [], // Liste des questions récupérées depuis le backend
        };
    },
    mounted() {
        // Faites une requête pour récupérer les questions depuis le backend
        // Utilisez axios ou fetch pour cela
        // Une fois les données récupérées, remplissez this.questions avec les questions obtenues
    },
    methods: {
        submitForm() {
            // Ajoutez ici la logique pour soumettre les réponses au backend
        },
    },
};
</script>

<style scoped>
/* Ajoutez ici vos styles CSS si nécessaire */
</style>
