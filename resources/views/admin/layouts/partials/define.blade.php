<script>
    window.google_map_key = '{!! config('services.google.map_key') !!}';
    window.laravel_token = '{!! csrf_token() !!}';
    const MAX_IMAGE_UPLOAD_SIZE = {!! MAX_IMAGE_UPLOAD_SIZE !!}; //BK
    const MAX_FILE_UPLOAD_SIZE = {!! MAX_FILE_UPLOAD_SIZE !!}; //BK
    const IMAGE_TYPE_ACCEPT = '{!! IMAGE_TYPE_ACCEPT !!}'; //BK
    const JS_DATE_TIME = '{!! JS_DATE_TIME !!}'; //BK
    const JS_DATE = '{!! JS_DATE !!}'; //BK
</script>