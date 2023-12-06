document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form'); // Remplacez 'inscription_form' par l'ID de votre formulaire Symfony
    form.addEventListener('submit', function (event) {
        console.log("a")
        var nom = document.getElementById('register_firstname').value; // Remplacez 'inscription_nom' par l'ID de votre champ 'nom'
        var prenom = document.getElementById('register_lastname').value; // Remplacez 'inscription_prenom' par l'ID de votre champ 'prenom'
        var email = document.getElementById('register_email').value; // Remplacez 'inscription_email' par l'ID de votre champ 'email'
        var motDePasse = document.getElementById('register_password_first').value; // Remplacez 'inscription_motDePasse' par l'ID de votre champ 'motDePasse'
        var motDePasseRepeat = document.getElementById('register_password_second').value; // Remplacez 'inscription_motDePasse' par l'ID de votre champ 'motDePasse'
        var day = document.getElementById('register_birthdate_day').value; // Remplacez 'inscription_motDePasse' par l'ID de votre champ 'motDePasse'
        var month = document.getElementById('register_birthdate_month').value; // Remplacez 'inscription_motDePasse' par l'ID de votre champ 'motDePasse'
        var year = document.getElementById('register_birthdate_year').value; // Remplacez 'inscription_motDePasse' par l'ID de votre champ 'motDePasse'

        var errorMessage = '';

        
        if (nom === '' || prenom === '' || email === '' || motDePasse === '' || motDePasseRepeat === '' || day === '' || month === '' || year === '') {
            errorMessage = 'Tous les champs sont obligatoires.';

            // Créer une nouvelle div pour le message d'erreur
            var errorDiv = document.createElement('div');
            errorDiv.classList.add('error-message'); // Ajouter une classe pour le style CSS si nécessaire

            // Créer un paragraphe pour le message d'erreur
            var errorParagraph = document.createElement('p');
            errorParagraph.textContent = errorMessage;

            // Ajouter le paragraphe à la div
            errorDiv.appendChild(errorParagraph);

            // Insérer la div avec le message d'erreur avant le formulaire
            form.parentNode.insertBefore(errorDiv, form);
        }else{
            errorMessage = 'a';
        }

        // Autres vérifications si nécessaire...

        // Empêcher l'envoi du formulaire si des erreurs sont présentes
        if (errorMessage !== '') {
            event.preventDefault();
        }
    });
});