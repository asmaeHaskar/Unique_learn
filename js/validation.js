/**
 * Form Validation for Inscription - Unique Learn
 */
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('inscriptionForm');

    if (form) {
        form.addEventListener('submit', function (e) {
            let errors = [];

            // Mandatory fields check using a loop (as required by specs)
            const requiredFields = [
                { id: 'nom', label: 'Nom' },
                { id: 'prenom', label: 'Prénom' },
                { id: 'email', label: 'Email' },
                { id: 'id_formation', label: 'Formation' }
            ];

            for (let i = 0; i < requiredFields.length; i++) {
                const field = document.getElementById(requiredFields[i].id);
                if (!field.value.trim()) {
                    errors.push("Le champ " + requiredFields[i].label + " est obligatoire.");
                }
            }

            // Email format check using regex
            const emailValue = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailValue && !emailRegex.test(emailValue)) {
                errors.push("L'adresse email saisie n'est pas valide.");
            }

            // If errors, prevent submission and alert
            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join("\n"));
                return false;
            }

            return true;
        });
    }
});
