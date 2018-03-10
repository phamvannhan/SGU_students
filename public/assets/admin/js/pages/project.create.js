var map, marker;
var defaultLocation = {lat: 14.058324, lng: 108.277199}; //Viet nam
var _location = null;
var defaultLocationZoom = 5;
var google_map = "google_map";
var output = {
    'elementId': 'address',
    "options": {
        "country": "VN"
    }
};
var _date = new Date();

var urlJsonLocation = 'https://maps.googleapis.com/maps/api/geocode/json?key=' + window.google_map_key + '&components=country:vn&address=';

function initMap(centerMap) {
    if (!centerMap) {
        return false;
    }
    map = new google.maps.Map(document.getElementById(google_map), {
        zoom: defaultLocationZoom,
        zoomControl: true,
        scaleControl: false,
        // scrollwheel: false,
        center: centerMap,
        mapTypeControl: false,
        panControl: false,
        streetViewControl: false,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        }
    });

    marker = new google.maps.Marker({
        position: centerMap,
        draggable: true,
        map: map
    });

    google.maps.event.addListener(marker, 'drag', function () {
        $("#project_lat").val(marker.getPosition().lat());
        $("#project_lng").val(marker.getPosition().lng());
    });
}

function setDataAddress(dataLocation) {
    if (typeof dataLocation != "undefined"
        && ( dataLocation === null || typeof dataLocation.lat == "undefined" || !dataLocation.lat  )) {

        var _address = $.trim($("#address").val());

        if (_address) {
            getJsonLocationFromGoogle(urlJsonLocation + _address, function (res) {
                if (typeof res != "undefined" && res && typeof res.status != "undefined" && res.status == "OK") {
                    var data = res.results[0];
                    $("#project_lat").val(data.geometry.location.lat);
                    $("#project_lng").val(data.geometry.location.lng);

                    var centerMap = {lat: data.geometry.location.lat, lng: data.geometry.location.lng};
                    _location = centerMap;
                    defaultLocationZoom = 14;
                    if (marker) {
                        marker.setMap(null);
                        initMap(centerMap);
                    }
                    else {
                        initGMap(centerMap);
                    }
                }
                else {
                    $("#project_lng").val("");
                    $("#project_lng").val("");
                    var centerMap = defaultLocation;
                    defaultLocationZoom = 5;
                    initMap(centerMap);
                    alert("Invalid address!");
                }
            });
        }
    }
    else {
        if (dataLocation.lat) {
            $("#project_lat").val(dataLocation.lat);
            $("#project_lng").val(dataLocation.lng);

            var centerMap = {lat: dataLocation.lat, lng: dataLocation.lng};
            _location = centerMap;
            defaultLocationZoom = dataLocation.zoom;
            if (marker) {
                marker.setMap(null);
                initMap(centerMap);
            }
            else {
                initMap(centerMap);
            }
        }
        else {
            setDataAddress(null);
        }
    }

}


jQuery(function ($) {
    $('#form-form').validate({
        focusInvalid: false,
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
        },
        ignore: "",
        rules: {
            'type': {required: true},
            'name': {required: true},
            'description': {required: true},
            'contact_phone' : {required: true, minlength:8, maxlength: 15},
            address : {required: true},
            lat: {
                required: function () {
                    if ($.trim($("#address").val())) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            }
        }
    });

    $('a[href="#location"]').on('shown.bs.tab', function (e) {
        e.target // newly activated tab
        e.relatedTarget // previous active tab

        var center = _location ? _location : defaultLocation;
        initMap(center);
    });

    $(window).load(function () {
        googleAutoComplete(output, setDataAddress);
        var lat = $("#project_lat").val();
        var lng = $("#project_lng").val();
        if (lat && lng) {
            _location = {
                lat: parseFloat(lat),
                lng: parseFloat(lng)
            };
            defaultLocationZoom = 13;
        }
    });
});