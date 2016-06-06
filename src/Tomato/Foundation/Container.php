<?php
namespace Tomato\Foundation;
/**
 * Created by luyh@59store.com.
 * User: luyh
 * Date: 16/6/2
 * Time: 下午3:42
 */

use \ReflectionClass;

class Container implements IContainer
{
    //存储单例数组
    private $_singletons = [];


    //存储已定义  却未实例化的class
    private $_definitions = [];

    //存储对象实例化需要的参数
    private $_params = [];

    //存储依赖类集合
    private $_dependenies = [];

    //存储反射类的集合
    private $_reflections = [];

    //保存单例实例
    private static $_instance;


    //防止外部new,维持单例,运行周期内只需要一个容器
    private function __construct()
    {

    }

    /**
     * Author     : luyh@59store.com
     * Description: [获取单一实例]
     * @return mixed
     */
    public static function singleton ()
    {
        if (!isset(self::$_instance)) {
            $c = __CLASS__;
            self::$_instance = new $c;
        }
        return self::$_instance;

    }


    /**
     * Author     : luyh@59store.com
     * Description: [获取bean]
     * @param $key
     * @param $param
     * @param $config
     * @return mixed
     */
    function get($key, $param=[], $config=[])
    {
        if (isset($this->_singletons[$key])) {
            return $this->_singletons[$key];
        }

        $definition = $this->_definitions[$key];

        if ( is_callable($definition)) {
            return call_user_func($definition, $param, true);
        }elseif (is_array($definition)) {
            $classCreate = $definition['class'];
            unset($definition['class']);
            list($dependencies,$reflection) = $this->getDependency($classCreate);
        }
    }

    public function resolveDependency($dependency=[],$reflection=null)
    {

    }

    /**
     * Author     : luyh@59store.com
     * Description: [设置bean]
     * @param $key
     * @param $param
     * @param $config
     * @return Object
     */
    public function set($key, $param=[], $config=[])
    {
        $this->_definitions[$key] = $param;
        $this->_params[$key] = $param;
        return $this;
    }



    public function getDependency($class)
    {
        ////存储依赖
        $dependencies = [];

        //获取当前类名的反射类
        $reflectionClass = new ReflectionClass($class);


        //获取构造函数中的依赖并存入数组
        $constructor = $reflectionClass->getConstructor();
        if (null === $constructor)  {
            $this->_dependenies[$class] = null;
            $this->_reflections[$class] = $reflectionClass;
            return ['dependencies' => null, 'reflection' => $reflectionClass];
        }

        $parameters = $constructor->getParameters();
        foreach ($parameters as $param) {
            if ($param->isDefaultValueAvailable()) {
                //作为字符串存入依赖数组  交由resolve去处理
                $dependencies[] = $param->getDefaultValue();
            }else{
                //$c 反射类型
                $c = $param->getClass();
                $className = $c->getName();
                $dependencies[] = $className;
            }
        }
        //记录某一个类的反射类实例
        $this->_reflections[$class] = $reflectionClass;
        $this->_dependenies[$class] = $dependencies;

        return [$dependencies, $reflectionClass];

    }



    public function builder($class, $param=[], $config=[])
    {

    }


}