jQuery(function ($) {
    $('#role').select2({
        placeholder: "---"
    });

    $('#city').select2();

    $('#birthday').datepicker({
        autoclose: true,
        container: '#birthday-container'
    });

    $('#id_number_date').datepicker({
        autoclose: true,
        container: '#id_number_date-container'
    });

    new Cleave('#id_number_date', {
        date: true,
        delimiter: '-',
        datePattern: ['d', 'm', 'Y']
    });

    new Cleave('#birthday', {
        date: true,
        delimiter: '-',
        datePattern: ['d', 'm', 'Y']
    });

    $('#form-form').validate({
        ignore: "",
        rules: {
            "role[]": {
                required: true
            },
            'name': {
                required: true,
                minlength: 2
            },
            'email': {
                required: true,
                email: true
            },
            'password': {
                required: function () {
                    if (typeof is_edit_page === 'undefined') {
                        return true;
                    }
                    return false;
                },
                minlength: 6
            }
        },
        highlight: function (element) {
            $(element).closest('.tab-pane').addClass("tab-error");
            $(element).addClass("input-error");
            var tab_content = $(element).closest('form');
            if ($(".active.tab-error label.error").length == 0) {
                var _id = $(tab_content).find(".tab-error:not(.active)").attr("id");
                $('a[href="#' + _id + '"]').tab('show');
            }

            $(element).parents('.form-line').addClass('error');
        },
        unhighlight: function (element) {
            $(element).closest('.tab-pane').removeClass("tab-error");
            $(element).removeClass("input-error");

            $(element).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });
});