var COMPANY_ID = null;

var vm = new Vue({
    el: '#vue_companyShareModal',
    data: {
        name: null,
        charter_capital: null,
        price_of_share: null,
        total_share: null,
        users_count: null,
        percent: null,
        price: null,
        new_charter_capital: null,
        new_total_share: null,
        excess_share: null,
    },
    watch: {
        percent: function (val) {
            if (val > 100) {
                toastr['error']('Vui lòng nhập số dưới 100.');
                this.percent = null;
            }
            else {
                this.percent = val;
                this.autoReloadData();
            }
        },

        price: function (val) {
            if (val) {
                val = this.stringToNumber(val)
                this.price = this.formatNumber(val);
            }
            this.autoReloadData();

        },
        new_charter_capital: function () {
            return this.new_charter_capital = this.formatNumber(this.new_charter_capital);
        },
        new_total_share: function () {
            return this.new_total_share = this.formatNumber(this.new_total_share);
        },
        excess_share: function () {
            return this.excess_share = this.formatNumber(this.excess_share);
        }
    },
    methods: {
        stringToNumber: function stringToNumber(str) {
            if (!str) {
                return str;
            }

            if (isNaN(str)) {
                let num = str.replace(/,/g, '');
                return Number(num);
            }
            return str;
        },

        formatNumber(num){
            if (!num) {
                return num;
            }

            if (typeof num === 'string') {
                return num.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            else {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        },

        autoReloadData: function () {
            if (this.percent && this.price) {
                let percent = this.stringToNumber(this.percent);
                let price = this.stringToNumber(this.price);
                let price_of_share = this.stringToNumber(this.price_of_share);
                let total_share = this.stringToNumber(this.total_share);
                let new_charter_capital = price / percent * 100;
                let new_total_share = new_charter_capital / price_of_share;

                this.new_charter_capital = new_charter_capital;
                this.new_total_share = new_total_share;
                this.excess_share = new_total_share - total_share - (percent / 100 * new_total_share); // thặng dư cổ phần
            }
            else {
                this.new_charter_capital = null;
                this.new_total_share = null;
                this.excess_share = null;
            }
        }
    }
});

jQuery(function ($) {
    var linkDatatable = $('meta[name=linkDatatable]').attr('content');

    var _table = $("#datatable").DataTable({
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100, 200, -1], [10, 25, 100, 200, "All"]],
        pageLength: 25,
        ajax: {
            url: linkDatatable,
        },
        columns: [
            // {data: 'id', name: 'id'},
            {
                data: 'no',
                render: function (data, type, row, meta) { return meta.row + meta.settings._iDisplayStart + 1; },
                orderable: false, searchable: false
            },

            {data: 'alias_name', name: 'alias_name', orderable: false},

            {data: 'charter_capital', name: 'charter_capital', orderable: false},

            {data: 'price_of_share', name: 'price_of_share', orderable: false},

            {data: 'total_share', name: 'total_share', orderable: false},

            {data: 'users_count', name: 'users_count', orderable: false, searchable: false},

            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        language: {
            url: '/assets/plugins/jquery-datatable/languages/vi.json'
        },

        "drawCallback": function (settings) {
            $('#load__page').fadeOut();
        }
    });

    $('body').on('click', '.btn-create-record', function () {
        let href = $(this).attr('href');
        let tr = $(this).closest('tr');
        let data = _table.row(tr).data();
        COMPANY_ID = data.id;
        vm.name = data.alias_name;
        vm.charter_capital = data.charter_capital;
        vm.price_of_share = data.price_of_share;
        vm.total_share = data.total_share;
        vm.users_count = data.users_count;
        vm.percent = null;
        vm.price = null;
        $('#companyShareModal').modal('show');
        return false;
    });

    $('#btn_save').click(function (e) {
        let price = $('#share_price').val();
        let percent = $('#share_percent').val();
        if (!price || !percent) {
            toastr['error']('Vui lòng nhập đủ thông tin');
            return false;
        }

        if (confirm("Vui lòng xác nhận phát hành cổ phần!") == true) {
            price = vm.stringToNumber(price);

            let data = {
                company_id: COMPANY_ID,
                price: price,
                percent: percent,
            };

            $('#load__page').show();
            $.ajax({
                type: 'POST',
                data: data,
                url: COMPANY_SHARE_CREATE_URL
            }).done(function (res) {
                toastr['success']('Phát hành cổ phần thành công.');
                _table.draw();
                $('#companyShareModal').modal('hide');
            }).fail(function (res) {
                toastr['error']('Phát hành cổ phần bị lỗi');
                $('#load__page').fadeOut();
            })
        }
    });
});