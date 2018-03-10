<?php namespace App\Traits;

trait HandleFIleTrait
{
    public function storeFile($file, $config, $old_file = null)
    {
        $arr = [
            'size' => $file->getClientSize() / 1024,
            'ext' => $file->extension(),
            'path' => \Storage::putFile($config["path"], $file)
        ];
        $this->deleteFile($old_file);
        return $arr;
    }

    public function deleteFile($path)
    {
        return !empty($path) ? \Storage::delete($path) : false;
    }
}
