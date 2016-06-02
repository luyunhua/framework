<?php
namespace Tomato\Foundation;
/**
 * Created by luyh@59store.com.
 * User: luyh
 * Date: 16/6/2
 * Time: 下午3:42
 */
class Container implements IContainer
{
    private $beans = [];

    //保存单例实例
    private static $_instance;


    //防止外部new,维持单例,运行周期内只需要一个容器
    private function __construct()
    {

    }

    public static function singleton ()
    {
        if (!isset(self::$_instance)) {
            $c = __CLASS__;
            self::$_instance = new $c;
        }
        return self::$_instance;

    }


    function get($key)
    {
        return $this->beans[$key];
    }

    function set($key, callable $callback)
    {
        $ret = call_user_func($callback);
        $this->beans[$key] = $ret;
    }


}