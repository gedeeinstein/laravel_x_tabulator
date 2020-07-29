$(function () {
    // init: side menu for current page
    $('li#menu-users').addClass('menu-open active');
    $('li#menu-users').find('.treeview-menu').css('display', 'block');
    $('li#menu-users').find('.treeview-menu').find('.edit-users a').addClass('sub-menu-active');

    $('#user-form').validationEngine('attach', {
        promptPosition : 'topLeft',
        scroll: false
    });

    // init: show tooltip on hover
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    // show password field only after 'change password' is clicked
    $('#reset-button').click(function (e) {
        $('#reset-field').removeClass('hide');
        $('#show-password-check').removeClass('hide');
        // to always uncheck the checkbox after button click
        $('#show-password').prop('checked', false);
    });

    // toggle password in plaintext if checkbox is selected
    $("#show-password").click(function () {
        $(this).is(":checked") ? $("#password").prop("type", "text") : $("#password").prop("type", "password");
    });
});
