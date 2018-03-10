jQuery(function ($) {

    $('#role').select2({
        placeholder: "---"
    });
    
    $('#form-form').validate({
        rules: {
            'contact_email': {
                required: true,
                email: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
});