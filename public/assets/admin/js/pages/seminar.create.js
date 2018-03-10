jQuery(function ($) {
    $('#start_time').datetimepicker({
        format: JS_DATE_TIME,
        widgetParent: '#start_time-container',
        showClose: true
    });

    new Cleave('#start_time', {
        delimiters: ['-', '-', ' ', ':'],
        blocks: [2, 2, 4, 2, 2]
    });

    $('#form-form').validate({
        focusInvalid: true,
        highlight: function(element) {
            $(element).parents('.form-line').addClass('error');
        },
        unhighlight: function(element) {
            $(element).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        },
        ignore: "",
        rules: {
            'type': {required: true},
            'name': {required: true},
            'address': {required: true},
            'description': {required: true},
            'start_time': {required: true},
            'url': {required: true, url:true},
        }
    });
});