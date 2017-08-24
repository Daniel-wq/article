<?php

/**
 * 1、载入模板文件的类
 * 2、因为下面许多地方（登录、注册、首页...）都需要载入模板文件，在这里声明一个类，以后需要载入模板文件的时候，可以直接调用该类中的该方法，不需要重复书写代码，节省空间，也节省代码运行的时间，同时也使代码结构更加清晰
 * Class Base
 */
abstract class Base{
    protected function view($data){
        /**
         * 载入模板
         */
        $c = strtolower(CONTROLLER);
        $a = strtolower(ACTION);
        //include "./view/member/login.php";
        include "./view/$c/$a.php";
    }
}