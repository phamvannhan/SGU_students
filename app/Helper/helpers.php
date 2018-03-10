<?php
function restSuccess($message = "Success", $result = [], $code = 200)
{
    $arr = [
        "status" => true,
        "status_code" => $code,
        "message" => $message,
    ];
    if (!empty($result)) {
        $arr["result"] = $result;
    }
    return response()->json($arr, $code);
}

function restFail($message = "Error", $code = 422, $errors = [])
{
    $arr = [
        "status" => false,
        "status_code" => $code,
        "message" => $message
    ];
    if (!empty($errors)) {
        $arr["errors"] = $errors;
    }
    return response()->json($arr, $code);
}

function randStrGen($len = 7, $chars = '1QAZXSW23EDCVFR45TGBNHY67UJMKI89OLP0')
{
    $result = "";
    $charArray = str_split($chars);
    for ($i = 0; $i < $len; $i++) {
        $randItem = array_rand($charArray);
        $result .= "" . $charArray[$randItem];
    }
    return $result;
}

function assetStorage($path, $type = "full", $multi = false, $key = "medium")
{
    if (empty($path)) {
        return null;
    }
    if ($type === "storage" || $type === "full") {
        $path = "/storage/{$path}";
    }
    if ($type === "full") {
        $path = asset($path);
    }
    if ($multi) {
        $arr = explode("/", $path);

        $file_name = $arr[count($arr) - 1];
        unset($arr[count($arr) - 1]);

        $new_path = implode("/", $arr);

        $arr_path = [
            "small" => $new_path . "/small/" . $file_name,
            "medium" => $new_path . "/medium/" . $file_name,
            "large" => $new_path . "/large/" . $file_name,
            "full" => $new_path . "/" . $file_name,
        ];

        if ($key && !empty($arr_path[$key])) {
            return $arr_path[$key];
        }
        return $arr_path;
    }

    return $path;
}

function currentPageMenu($url, $class = "active")
{
    if (!is_array($url)) {
        $check = request()->is($url);
        return $check ? $class : "";
    } else {
        foreach ($url as $key => $value) {
            if (request()->is($value)) {
                return $class;
            }
        }
    }
    return "";
}

function cvDbTime($date, $from = DB_DATE, $to = PHP_DATE)
{
    return $date ? \Carbon\Carbon::createFromFormat($from, $date)->format($to) : null;
}

function resourceAdmin($prefix, $controller, $name, $permission = null, array $except = ['show'])
{
    if ($permission === null) {
        $permission = $name;
    }
    Route::group(['prefix' => $prefix], function () use ($controller, $name, $permission, $except) {
        if (!in_array('index', $except)) {
            Route::get('/', "{$controller}@index")->name("admin.{$name}.index")->middleware("permission:admin.{$permission}.index");
        }

        if (!in_array('datatable', $except)) {
            Route::get('datatable', "{$controller}@datatable")->name("admin.{$name}.datatable")->middleware("permission:admin.{$permission}.index");
        }

        if (!in_array('create', $except)) {
            Route::get('create', "{$controller}@create")->name("admin.{$name}.create")->middleware("permission:admin.{$permission}.create");
            Route::post('/', "{$controller}@store")->name("admin.{$name}.store")->middleware("permission:admin.{$permission}.create");
        }

        if (!in_array('show', $except)) {
            Route::get('{id}', "{$controller}@show")->name("admin.{$name}.show")->middleware("permission:admin.{$permission}.show");
        }

        if (!in_array('edit', $except)) {
            Route::get('{id}/edit', "{$controller}@edit")->name("admin.{$name}.edit")->middleware("permission:admin.{$permission}.edit");
            Route::put('{id}', "{$controller}@update")->name("admin.{$name}.update")->middleware("permission:admin.{$permission}.edit");
        }

        if (!in_array('destroy', $except)) {
            Route::delete('{id}', "{$controller}@destroy")->name("admin.{$name}.destroy")->middleware("permission:admin.{$permission}.destroy");
        }
    });
}

function cutString($string, $length = 15, $end = '...')
{
    $string = trim($string);
    $l = strlen($string);
    if ($length >= $l) {
        return $string;
    }
    return substr($string, 0, $length) . $end;
}

function stringToNumberArray(&$array, $key)
{
    if(is_array($key)){
        foreach ($key as $rs){
            if(!empty($array[$rs])){
                $array[$rs] = str_replace(',', '', $array[$rs]);
            }
        }
    }
    else{
        if(!empty($array[$key])){
            $array[$key] = str_replace(',', '', $array[$key]);
        }
    }

}
