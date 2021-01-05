
// SO definitions
//  login
const validateLogin = function() {
    var formData = new FormData(form);
    if ($('#username').val() == "" || $('#password').val() == "") {
        $('#err').html("You did not enter anything!");
        $('#err').show();
        $('#succ').hide();
    } else {
        $.ajax({
            processData: false,
            contentType: false,
            url: 'ajax/ajax_login.php',
            data: formData,
            type: 'POST',
            success: function(data) {
                var status = JSON.parse(data);
                $('#err').hide();
                    $('#succ').html(status.success);
                    $('#succ').show();
                if (typeof status.error != "undefined") {
                    $('#succ').hide();
                    $('#err').html(status.error);
                    $('#err').show();
                } else
                    window.location.href = '../index.php';
            }
        });
    }
};
// signup
const validateSignup = function() {
    var formData = new FormData(document.getElementById('register'));
    s_username   = $('#s_username').val();
    s_password   = $('#s_password').val();
    s_cpassword  = $('#s_cpassword').val();
    s_email      = $('#s_email').val();
    s_ref        = $('#s_ref').val();
    if (s_username == "" || s_password == "" || s_cpassword == "" || s_email == "" || s_ref == "") {
        $('#succ').hide();
        $('#err').html("Please fill all the fields correctly!");
        $('#err').show();
    } else {
        //validation check
        formData.append('type', 'validate');
        $.ajax({
            processData: false,
            contentType: false,
            url: 'ajax/ajax_signup.php',
            data: formData,
            type: 'POST',
            success: function(data) {
                var ret_val = JSON.parse(data);
                if (ret_val.status == 'success') {
                    $('#err').hide();
                    $('#succ').html(ret_val.data);
                    $('#succ').show();
                    $(".tabs-buttons [data-tab=register]").removeClass("active");
                    $(".tabs-buttons [data-tab=login]").addClass("active");
                    $(".tabs-content [data-tab=register]").removeClass("active");
                    $(".tabs-content [data-tab=login]").addClass("active");
                    //    make login part
                    $('#username').val(s_username);
                    $('#password').val(s_password);
                    validateLogin();
                } else {
                    $('#succ').hide();
                    $('#err').html(ret_val.data);
                    $('#err').show();
                }
            }
        });
    }
};
// EO definitions

// SO page load behavior
$(document).ready(function() {

    // success and error feedback  
    $('#err').hide();
    $('#succ').hide();

    // TODO getting online/offline users
    // $.ajax({
    //     'url' : 'ajax/onlinedata.php',
    //     'type' : 'POST',
    //     'data' : {},
    //     'success' : function(data) {
    //         var response = JSON.parse(data);
    //         $('#users').html(response.users);
    //         $('#onlinenow').html(response.onlinenow);
    //     },
    //     'error' : function(request,error){}
    // });

})
// EO page load behavior