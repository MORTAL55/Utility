<?php
/**
 * 文件上传 doc txt pdf xlsx
 * Created by PhpStorm.
 * User: MORTAL
 * Date: 2019/3/14
 * Time: 8:38
 */

namespace App\Libs\Upload;


class File extends Base
{
    /**
     * 文件类型
     * @var string
     */
    public $fileType = "file";
    /**
     * 允许上传的最大文件 2M
     * @var int
     */
    public $maxSize = 2048000;

    /**
     * 允许上传的文件格式 txt docx pdf xlsx
     * @var array
     */
    public $fileExtType = [
        'plain',
        'vnd.openxmlformats-officedocument.wordprocessingml.document',
        'pdf',
        'vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];
}