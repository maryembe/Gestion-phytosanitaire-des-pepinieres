document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('form_Control_doc');
    
    // Vérifier si le formulaire a été soumis précédemment (vérification du cookie)
    var isFormSubmitted = getCookie('formSubmitted');
    
    // Si le formulaire a été soumis, masquer le formulaire
    if (isFormSubmitted) {
      form.style.display = 'none';
      
      // Afficher le message de succès
      var message = document.createElement('div');
      message.classList.add('message');
      message.textContent = 'Le formulaire a été enregistré avec succès.';
      document.body.appendChild(message);
    }
    
    form.addEventListener('submit', function(event) {
      // Empêcher l'envoi du formulaire
      event.preventDefault();
      
      // Désactiver tous les champs du formulaire
      var formElements = form.elements;
      for (var i = 0; i < formElements.length; i++) {
        formElements[i].disabled = true;
      }
      
      // Masquer le formulaire
      form.style.display = 'none';
      
      // Définir le cookie pour indiquer que le formulaire a été soumis
      setCookie('formSubmitted', 'true', 365);
      
      // Afficher le message de succès
      var message = document.createElement('div');
      message.classList.add('message');
      message.textContent = 'Le formulaire a été enregistré avec succès.';
      document.body.appendChild(message);
    });
    
    // Fonction pour définir un cookie
    function setCookie(name, value, days) {
      var expires = '';
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = '; expires=' + date.toUTCString();
      }
      document.cookie = name + '=' + (value || '') + expires + '; path=/';
    }
    
    // Fonction pour obtenir la valeur d'un cookie
    function getCookie(name) {
      var nameEQ = name + '=';
      var cookies = document.cookie.split(';');
      for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
          cookie = cookie.substring(1, cookie.length);
        }
        if (cookie.indexOf(nameEQ) === 0) {
          return cookie.substring(nameEQ.length, cookie.length);
        }
      }
      return null;
    }
  });