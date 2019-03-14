<?php
/**
 * 反射工具类
 * Created by PhpStorm.
 * User: mortal
 * Date: 18-12-24
 * Time: 下午4:53
 */

namespace App\Libs\Utils;

class Reflection
{
    /**
     * 反射需要的类
     * @return array
     */
    public function uploadClassStat()
    {
        return [
            "image" => "\App\Libs\Upload\Image",
            "video" => "\App\Libs\Upload\Video",
            "file" => "\App\Libs\Upload\File",
        ];
    }

    /**
     * 初始化类
     * @param $type
     * @param $supportedClass
     * @param array $params
     * @param bool $isInstance
     * @return bool|object
     * @throws \ReflectionException
     */
    public function initClass($type, $supportedClass, $params = [], $isInstance = true)
    {
        if(!array_key_exists($type, $supportedClass)){
            return false;
        }

        $className = $supportedClass[$type];
        return $isInstance ? (new \ReflectionClass($className))->newInstanceArgs($params) : $className;
    }
}