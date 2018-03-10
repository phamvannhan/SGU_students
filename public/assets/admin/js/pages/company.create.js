jQuery(function ($) {
    $('#deputy_birthday').datepicker({
        autoclose: true,
        container: '#deputy_birthday-container'
    });

    $('#deputy_id_date').datepicker({
        autoclose: true,
        container: '#deputy_id_date-container'
    });

    new Cleave('#deputy_birthday', {
        date: true,
        delimiter: '-',
        datePattern: ['d', 'm', 'Y']
    });

    new Cleave('#deputy_id_date', {
        date: true,
        delimiter: '-',
        datePattern: ['d', 'm', 'Y']
    });

    new Cleave('#total_share', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    new Cleave('#price_of_share', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    new Cleave('#charter_capital', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });
    $('#form-form').validate({
        ignore: "",
        rules: {
            "code": {
                required: true
            },
            'name': {
                required: true,
                minlength: 2
            },
            'charter_capital': {
                required: true,
            },

            'total_share': {
                required: true,
            },
            'price_of_share': {
                required: true,
            },

            'fixed_money': {
                number: true,
                min: 0,
            },

            'expected_money': {
                number: true,
                min: 0,
            },
            'interest_in_3_years': {
                number: true,
                min: 0,
            },
            'interest_ipo': {
                number: true,
                min: 0,
            },

            'investment_share': {
                number: true,
                min: 0,
            },
            'day_pay' : {
                required: true,
                number: true,
                min: 1,
                max: 31,
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