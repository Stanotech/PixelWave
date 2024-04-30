/**
* PHP Email Form Validation - v3.6
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  const errorMessage = {
    'en': {
      'fill': 'Please fill out all fields!',
      'submission': 'Form submission failed and no error message returned from: ',
      'noAction': 'Form action attribute is not set!',
      'noRecaptcha': 'The reCaptcha javascript API url is not loaded!'
    },
    'pl': {
      'fill': 'Proszę wypełnić wszystkie wymagane pola!',
      'submission': 'Wysłanie formularza nie powiodło się i nie zwrócono żadnej wiadomości błędu z: ',
      'noAction': 'Atrybut akcji formularza nie jest ustawiony!',
      'noRecaptcha': 'Adres URL interfejsu API reCaptcha nie jest załadowany!'
    },
  }
  
  let forms = document.querySelectorAll('.php-email-form');
  
  function getPageLanguage() {
    let lang = document.documentElement.lang;
    return lang ? lang.toLowerCase() : 'en';
  }
  
  forms.forEach( function(e) {
    e.addEventListener('submit', function(event) {
      event.preventDefault();

      let thisForm = this;
      
      const fields = thisForm.querySelectorAll('[name]');
      let formIsValid = true;
      
      fields.forEach( function(e) {
        if('' === e.value) {
          e.classList.add('is-invalid');
          formIsValid = false;
        } else {
          e.classList.remove('is-invalid');
        }
      });
      
      if( !formIsValid ) {
        displayError(thisForm, errorMessage[getPageLanguage()].fill);
        return;
      }
      
      let action = thisForm.getAttribute('action');
      let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');
      
      if( ! action ) {
        displayError(thisForm, errorMessage[getPageLanguage()].noAction);
        return;
      }
      
      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData( thisForm );

      if ( recaptcha ) {
        if(typeof grecaptcha !== "undefined" ) {
          grecaptcha.ready(function() {
            try {
              grecaptcha.execute(recaptcha, {action: 'php_email_form_submit'})
              .then(token => {
                formData.set('recaptcha-response', token);
                php_email_form_submit(thisForm, action, formData);
              })
            } catch(error) {
              displayError(thisForm, error);
            }
          });
        } else {
          displayError(thisForm, errorMessage[getPageLanguage()].noRecaptcha);
        }
      } else {
        php_email_form_submit(thisForm, action, formData);
      }
    });
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {'X-Requested-With': 'XMLHttpRequest'}
    })
    .then(response => {
      if( response.ok ) {
        return response.text();
      } else {
        throw new Error(`${response.status} ${response.statusText} ${response.url}`);
      }
    })
    .then(data => {
      thisForm.querySelector('.loading').classList.remove('d-block');
      if (data.trim() == 'OK') {
        thisForm.querySelector('.sent-message').classList.add('d-block');
        thisForm.reset();
      } else {
        throw new Error(data ? data : errorMessage[getPageLanguage()].submission + action);
      }
    })
    .catch((error) => {
      displayError(thisForm, error);
    });
  }

  function displayError(thisForm, error) {
    thisForm.querySelector('.loading').classList.remove('d-block');
    thisForm.querySelector('.error-message').innerHTML = error;
    thisForm.querySelector('.error-message').classList.add('d-block');
  }

})();
