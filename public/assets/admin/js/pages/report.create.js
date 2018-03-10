jQuery(function ($) {
    $('#report_date').datepicker({
        autoclose: true,
        container: '#report_date-container'
    });

    new Cleave('#report_date', {
        date: true,
        delimiter: '-',
        datePattern: ['d', 'm', 'Y']
    });

    $('#form-form').validate({
        ignore: "",
        rules: {
            'name': {
                required: true,
                minlength: 2
            },
            'file': {
                required: function () {
                    if (typeof is_edit_page === 'undefined') {
                        return true;
                    }
                    return false;
                },
            },
            'type': {
                required: true,
            },
            'report_date': {
                required: true,
            }
        },
        highlight: function (element) {
            $(element).parents('.form-line').addClass('error');
        },
        unhighlight: function (element) {
            $(element).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
});