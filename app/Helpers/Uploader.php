<?php

namespace App\Helpers;

use Intervention\Image\ImageManager;

class Uploader
{

	function __construct()
	{
		$this->manager = new ImageManager();
	}

	public function upload($filepath = '', $newfile ='', $watermark_image = '')
    {
        $file = $this->manager->make($filepath)/*->resize(445, 458)*/;

        if($watermark_image != '')
            $file->insert($watermark_image, 'bottom-right', 10, 10);

        if($file->save($newfile))
            return true;
        return false;
    }

    public function getUploadDir($id, $path)
    {
        $dir_name = md5($id);
        $dir_path = $path.$dir_name;

        if (!file_exists($dir_path)) {
         	mkdir($dir_path, 0777, true);
        }
        return $dir_path;
    }
}