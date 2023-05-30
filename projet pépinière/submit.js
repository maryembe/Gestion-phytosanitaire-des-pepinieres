function validerFormulaire() {
    var v1 = document.getElementById("pass").value;
    var v2 = document.getElementById("c_pass").value;
    var div = document.getElementById("div_c_pass");

    if (v1 != v2) {
        alert("Veuillez comfirmer votre mot de passe.");
        return false; // Empêche la soumission du formulaire
    }
    // Autres conditions de validation...      
    return true; // Soumission du formulaire
}