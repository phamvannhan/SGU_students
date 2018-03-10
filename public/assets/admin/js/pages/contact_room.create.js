jQuery(function ($) {
    $('#form-form').validate({
        rules: {
            'name': {
                required: true,
                minlength: 2
            },
            'email': {
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