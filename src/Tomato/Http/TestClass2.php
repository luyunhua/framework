<?php
/**
 * Created by luyh@59store.com.
 * User: luyh
 * Date: 16/6/3
 * Time: 下午2:00
 */

namespace Tomato\Http;


class TestClass2
{
    public function __construct(TestClass3 $testClass3)
    {
        echo '003 called';
    }

}