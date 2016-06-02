<?php
/**
 * Created by luyh@59store.com.
 * User: luyh
 * Date: 16/6/2
 * Time: 下午4:54
 */

namespace Tomato\Route;

/**
 * Interface IRequest
 * @package Tomato\Route
 */
interface IRequest
{
    function get($key);

    function getRealMethod();

}