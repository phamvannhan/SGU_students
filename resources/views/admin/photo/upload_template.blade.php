<ul id="photos-template" class="hidden">
    <li class="disable-sort-item">
        <div class="box-image">
            <img src="IMAGE_BASE64" alt="photo" />
            <button type="button"
                    class="btn_delete_this"
                    data-parent="li"
                    data-multi="1">
                <i class="glyphicon glyphicon-remove"></i>
            </button>
        </div>
        <input type="hidden" name="INPUT_NAME" value="INPUT_VALUE">
    </li>
</ul>

<div id="photo-template" class="hidden">
    <div class="out-image">
        <img src="IMAGE_BASE64" alt="photo" />
        <input type="hidden" name="INPUT_NAME" value="INPUT_VALUE">
        <button class="btn_delete_this"
                data-name="delete_logo"
                data-value=""
                data-multi=""
                data-parent=".single-upload">
            <span class="glyphicon glyphicon-remove"></span>
        </button>
    </div>
</div>