<?php
/**
 * 上传图片
 * Created by PhpStorm.
 * User: mortal
 * Date: 18-12-24
 * Time: 下午4:18
 */

namespace App\Libs\Upload;


class Image extends Base
{
    /**
     * 文件类型
     * @var string
     */
    public $fileType = "image";

    /**
     * 允许上传的最大文件 2M
     * @var int kb
     */
    public $maxSize = 2048000;

    /**
     * 允许上传的图片格式
     * @var array
     */
    public $fileExtType = ['jpg', 'png', 'jpeg'];
}