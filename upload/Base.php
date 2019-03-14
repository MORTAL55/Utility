<?php
/**
 * 上传基础类库
 * Created by PhpStorm.
 * User: mortal
 * Date: 18-12-24
 * Time: 下午3:16
 */
namespace App\Libs\Upload;

use App\Libs\Utils\Utils;

class Base
{
    /**
     * 上传文件类型
     * @var string
     */
    public $type = '';

    /**
     * 文件大小
     * @var string
     */
    public $size = '';

    /**
     * @var null
     */
    private $request = null;

    public function __construct($request, $type = null)
    {
        $this->request = $request;
        if(empty($type)){
            $files = $this->request->getSwooleRequest()->files;
            $this->type = (array_keys($files))[0];
            //print_r($files);
        }else{
            $this->type = $type;
        }
    }

    /**
     * 上传文件
     * @return bool
     * @throws \Exception
     */
    public function upload()
    {
        if($this->type != $this->fileType){
            return false;
        }

        $videos = $this->request->getUploadedFile($this->type);
        $this->size = $videos->getSize();
        $this->checkSize();

        $fileName = $videos->getClientFileName();
        $this->clientMediaType = $videos->getClientMediaType();

        $this->checkMediaType();

        $file = $this->getFile($fileName);
        $flag = $videos->moveTo($file);

        if(!empty($flag)){
            return $this->file;
        }

        return false;
    }

    /**
     * 获取文件
     * @param $fileName
     * @return string
     */
    protected function getFile($fileName){
        $pathInfo = pathinfo($fileName);
        $extension = $pathInfo['extension'];
        // 上传文件的存储路径
        $dir =  EASYSWOOLE_ROOT . "/public/static/" . $this->type . '/' .date("Y") . '/' . date('m');
        if(!is_dir($dir)){
            mkdir($dir, 0777, true);
        }

        $basename = $dir ."/". Utils::getFileKey($fileName) .".".$extension;
        $this->file = $basename;
        return $basename;
    }

    /**
     * 检查文件大小
     * @return bool
     * @throws \Exception
     */
    protected function checkSize()
    {
        if(empty($this->size)){
            return false;
        }
        // to do 检查文件大小 类比type
        if($this->size > $this->maxSize){
            throw new \Exception("上传{$this->size}文件过大");
        }
        return true;
    }

    /**
     * 检测上传文件的格式
     * @return bool
     * @throws \Exception
     */
    protected function checkMediaType():bool
    {
        $clientType = explode("/", $this->clientMediaType);
        $clientType = $clientType[1] ?? ""; // 如果没有则为空
        // print_r($clientType);
        if(empty($clientType)){
            throw new \Exception("上传{$this->type}文件不合法");
        }
        if(!in_array($clientType, $this->fileExtType)){
            throw new \Exception("上传{$this->type}文件不合法");
        }
        return true;
    }
}