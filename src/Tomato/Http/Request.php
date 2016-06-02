<?php
/**
 * Created by luyh@59store.com.
 * User: luyh
 * Date: 16/6/2
 * Time: 下午4:56
 */

namespace Tomato\Http;

use ArrayAccess;


class Request implements ArrayAccess
{

    /**
     * Author     : luyh@59store.com
     * Description: [获取uri]
     * @return string
     */
    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * Author     : luyh@59store.com
     * Description: [获取url 不带host 不带query_string]
     * @return string
     */
    public function url()
    {
        return rtrim(preg_replace('/\?.*/', '', $this->getUri()), '/');
    }

    public function root()
    {
        return rtrim($_SERVER['HTTP_HOST'], '/');
    }

    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }


}