
if ( document.getElementsByName('servers_auth')[0] ) {

    var authTypeElements = document.getElementsByName('servers_auth')[0];

    authTypeElements.addEventListener('change', function(){

        if ( authTypeElements.value === 'pass') {
            document.getElementsByName('servers_pass')[0].removeAttribute('disabled');
        } else {
            if ( ! document.getElementsByName('servers_pass')[0].hasAttribute('disabled') ) {
                document.getElementsByName('servers_pass')[0].setAttribute('disabled', 'disabled');
                document.getElementsByName('servers_pass')[0].value = "";
            }
        }

    }, true);

}

if ( document.getElementById('cmd_input') ) {

    var body = document.getElementsByTagName('body')[0];

    body.onload = function() {

        document.getElementById('cmd_input').focus();

    }

}

$('#menu').hide();
$('#menuButton').click(function(){

    $('#menu').animate(
        {width: 'toggle'},
        350,
        function() {

            if ( $('#menu').is(':visible') ) {
                $('#content').animate({width: '-=210'},210);
            } else {
                $('#content').animate({width: '+=210'},210);
            }

        });
  
});

function passwordValidity (formId, passwdFieldName, confirmPasswdFieldName) {

    if ( document.getElementById(formId) ) {

        var formElement = document.getElementById(formId);
   
       formElement.oninput = function(){
   
           var passwordField = document.getElementsByName(passwdFieldName)[0];
           var confirmPassword = document.getElementsByName(confirmPasswdFieldName)[0];
   
       
           confirmPassword.setCustomValidity(passwordField.value != confirmPassword.value ? "Password do not match." : "");
   
       }
   
   }

}

passwordValidity('firstloginForm', 'password', 'password2');

passwordValidity('chpasswdForm', 'new_password', 'confirm_password');

passwordValidity('addUserForm', 'users_password', 'confirm_password');




