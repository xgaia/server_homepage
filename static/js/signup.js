$(function() {
    var password = '';
    var password2 = '';

    var bad_pass1 = true;
    var bad_pass2 = true;
    var bad_username = true;
    var bad_email = true;

    $("#username").focus();

    $( "#username" ).keyup(function() {
        username = $( this ).val();
        if (username.length == 0) {
            $("#username-div").attr('class', '');
            bad_username = true;
        }else{
            if (username.length < 0) {
                $("#username-div").attr('class', 'has-error');
                bad_username = true;
            }else{
                $("#username-div").attr('class', 'has-success');
                bad_username = false;
            }
            disable_button();
        }
    }).keyup();

    $( "#password" ).keyup(function() {
        password = $( this ).val();
        if (password.length == 0) {
            $("#password-div").attr('class', '');
            bad_pass1 = true;

        }else{
            if (password.length < 8) {
                $("#password-div").attr('class', 'has-error');
                $("#password2").prop('disabled', true);
                bad_pass1 = true;

            }else{
                $("#password-div").attr('class', 'has-success');
                $("#password2").prop('disabled', false);
                bad_pass1 = false;
            }
            disable_button();
        }
    }).keyup();

    $("#password2").keyup(function() {
        password2 = $(this).val();
        if (password2.length == 0) {
            $("#password-div2").attr('class', '');
            bad_pass2 = true;
        }else{
            if (password2 != password) {
                $("#password-div2").attr('class', 'has-error');
                bad_pass2 = true;
            }else{
                $("#password-div2").attr('class', 'has-success');
                bad_pass2 = false;
            }
            disable_button();
        }
    }).keyup();

    $("#email").keyup(function() {
        var email = $(this).val();
        if (email.length == 0) {
            $("#email-div").attr('class', '');
            bad_email = true;
        }else{
            if (is_valid_email(email)) {
                $("#email-div").attr('class', 'has-success');
                bad_email = false;
            }else{
                $("#email-div").attr('class', 'has-error');
                bad_email = true;
            }
        }
        disable_button();
    }).keyup();


    function disable_button() {
        //console.log('--> disable_button');
        //console.log('email: '+bad_email+' username '+bad_username+' pass1 '+bad_pass1+' pass2 '+bad_pass2);
        if (bad_email || bad_username || bad_pass1 || bad_pass2){
            console.log('disabled');
            $("#submit-button").prop('disabled', true);
        }else{
            console.log('enabled');
            $("#submit-button").prop('disabled', false);
        }
    }
});




//-----functions------------------------------------------------------------------------------
function is_valid_email(email) {
    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
    return pattern.test(email);
};
