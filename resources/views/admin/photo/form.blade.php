@if(empty($object_image['multi']))
    <div class="single-upload" id="{{ $object_image['append'] }}">
        @if(!empty($object_image['image']))
            <div class="out-image">
                <img src="{!!  $object_image['image'] !!}">
                <button class="btn_delete_this" data-name="{{ $object_image['delete'] }}" data-value="{!! $object_image['image_value'] !!}"
                        data-multi="" data-parent=".single-upload">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
            </div>
        @endif

        <div class="box-upload" @if(!empty($object_image['image'])) style="display: none;" @endif>
            <label for="select-photo" class="label-select-images">
                <span class="glyphicon glyphicon-picture"></span>
            </label>
            <input type="file"
                   id="select-photo"
                   data-append="#{{ $object_image['append'] }}"
                   data-name="{{ $object_image['name'] }}"
                   data-template="#photo-template"
                   data-callback="callbackHandlePhoto"
                   class="dz_select_photos"
                   accept="image/*">
        </div>
    </div>
@else
    <ul class="list-photos" id="{{ $object_image['append'] }}">
        @if(!empty($object_image['photos']))
            @foreach($object_image['photos'] as $rs)
                <li data-id="{{ $rs->id }}">
                    <div class="box-image">
                        <img src="{{ $rs->arrayPath(true)["medium"] }}" alt="{{ $rs->id }}">
                        <button type="button"
                                class="btn_delete_this"
                                data-parent ="li"
                                data-multi="1"
                                data-name="{{ $object_image['delete'] }}"
                                data-value="{{ $rs->id }}">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="clearfix"></div>
    <div class="multi-upload">
        <div class="box-upload">
            <label for="{{ $uniqid = uniqid() }}" class="label-select-images">
                <span class="glyphicon glyphicon-picture"></span>
            </label>
            <input type="file"
                   multiple
                   id="{{ $uniqid }}"
                   data-append="#{{ $object_image['append'] }}"
                   data-name="{{ $object_image['name'] }}"
                   data-template="#photos-template"
                   data-callback="callbackHandlePhotos"
                   class="dz_select_photos"
                   accept="image/*">
        </div>
    </div>
@endif