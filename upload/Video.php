<?php
/**
 * Created by PhpStorm.
 * User: mortal
 * Date: 18-12-24
 * Time: 下午3:16
 */
namespace App\Libs\Upload;

class Video extends Base
{
    /**
     * 文件类型
     * @var string
     */
    public $fileType = "video";
    /**
     * 允许上传的最大文件 2M
     * @var int
     */
    public $maxSize = 2048000;

    /**
     * 允许上传的视频格式
     * @var array
     */
    public $fileExtType = ['mp4', 'x-flv'];


}