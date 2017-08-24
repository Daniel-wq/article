<?php
//1、载入数据库
include './functions.php';
//开启session
session_start();

//控制器
$c = isset($_GET['c']) ? ucfirst($_GET['c']) : 'Home';
define('CONTROLLER',$c);

//方法
$a = isset($_GET['a']) ? strtolower($_GET['a']) : 'entry';
define('ACTION',$a);

//实例化并调用方法
call_user_func_array([new $c,$a],[]);