<?php
/**
 * Created by luyh@59store.com.
 * User: luyh
 * Date: 16/6/3
 * Time: 下午1:48
 */

namespace Tomato\Http;


class TestClass
{
    public function __construct(TestClass2 $testClass2)
    {
        echo 'test2 called';
    }

}