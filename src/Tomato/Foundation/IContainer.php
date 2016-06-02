<?php
/**
 * Created by luyh@59store.com.
 * User: luyh
 * Date: 16/6/2
 * Time: 下午3:50
 */

namespace Tomato\Foundation;


interface IContainer
{
    function get($key);

    function set($key, callable $callback);

}