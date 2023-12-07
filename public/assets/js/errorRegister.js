document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
       
        var monElement = document.querySelector('.error-display')
        var nom = document.getElementById('register_firstname').value;
        var prenom = document.getElementById('register_lastname').value;
        var email = document.getElementById('register_email').value;
        var motDePasse = document.getElementById('register_password_first').value;
        var motDePasseRepeat = document.getElementById('register_password_second').value;
        var day = document.getElementById('register_birthdate_day').value;
        var month = document.getElementById('register_birthdate_month').value;
        var year = document.getElementById('register_birthdate_year').value;

        if (nom === '' || prenom === '' || email === '' || motDePasse === '' || motDePasseRepeat === '' || day === '' || month === '' || year === '') {
            event.preventDefault();
            monElement.style.visibility = 'visible';

        }else{

        }
    });
});
