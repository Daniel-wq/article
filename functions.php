<?php
//用于打印的函数
function p($var){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

//设置时区
date_default_timezone_set('PRC');

/**
 * 跳转函数
 * @param $msg [提示信息]
 * @param $url [跳转地址]
 */
function go($msg,$url){
    header('Content-type:text/html;charset=utf-8');
    $str = <<<str
<script>
alert('$msg');
location.href = '$url';
</script>
str;
    exit($str);
}

/**
 * 使用未找到的类（实例化、静态调用）
 * @param $className [未找到的类名]
 */
function __autoload($className){
    include "./controller/{$className}.php";
}

/**
 * 把数据写入数据库文件
 * @param $file [数据库文件]
 * @param $data [要写入的数据]
 */
function dataToFile($file,$data){
    $data = var_export($data,true);
    $str = <<<str
<?php
return $data;
?>
str;
    file_put_contents($file,$str);

}


/**
 * 载入验证码类
 * @param $name
 */
function requireTool($name){
    include './lib/' . $name . '.php';
}

/**
 * 定义IS_POST
 */
define('IS_POST',$_SERVER['REQUEST_METHOD'] == 'POST' ? true : false);





















