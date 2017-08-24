<?php

/**
 * 会员管理控制器（登陆、注册、退出、修改密码...）
 * Class Member
 */
class Member extends Base {
    //声明数据库数组的属性
    private $data;
    //1、创建构造函数
    //2、因为下面好多地方，都需要用到引入数据库，所以在这里用构造函数引入数据库，下面可以直接调用。节省代码，也节省代码运行时间
    public function __construct(){
        $this->data = include './data.php';
    }

    /**
     * 登录动作
     */
    public function login(){
        //1、判断是否是IS_POST事件
        //2、如果是IS_POST事件，就运行以下代码，如果不是IS_POST事件，就不运行
        if (IS_POST){
            //1、比对用户输入的验证码是否正确
            //2、如果用户输入的验证码正确，那么接下来再去遍历数据库，比对用户名与密码；如果验证码不正确，就不运行遍历操作，直接提示用户，这样可以节省代码运行时间
            if (strtolower($_POST['code']) != $_SESSION['code']){
                go('验证码错误','?c=member&a=login');
            }
            //1、遍历数据库
            //2、为了把用户输入的用户名和密码与数据库中的数据进行比对，验证用户输入的是否正确，防止恶意登录
            foreach ($this->data as $k=>$v){
                //1、验证用户名与密码是否正确
                //2、如果正确，就运行以下代码；如果错误，就跳出该步，提示用户输入信息错误
               if ($_POST['username'] == $v['username'] && password_verify($_POST['password'],$v['password'])){
                   $_SESSION['user'] = [
                     'username' => $_POST['username']
                   ];
                   //1、判断用户是否选了7天免登陆操作
                   //2、如果用户选择了，就执行7天免登陆操作，如果没有，跳过该步
                   if (isset($_POST['autologin'])){
                       setcookie(session_name(),session_id(),time()+3600*24*7,'/');
                   }
                   go('登陆成功','index.php');
               }
            }
            go('登录失败','?c=member&a=login');
        }
        $this->view(['data'=>$this->data]);
    }

    /**
     * 注册动作
     */
    public function reg(){
        //1、判断是否是IS_POST事件
        //2、如果是IS_POST事件，就运行以下代码，如果不是IS_POST事件，就不运行
        if (IS_POST){
            //1、遍历数据库
            //2、为了把用户注册时输入的用户名与数据库中的用户名进行比对
            foreach ($this->data as $v){
                //1、比对用户名是否已被注册
                //2、如果用户名存在，就提示用户，需要重新注册，如果用户名不存在，就继续运行，为了避免用户名重复，造成混乱
                if ($v['username'] == $_POST['username']){
                    go('用户名已存在','?c=member&a=reg');
                }
            }
            //1、将用户填写的密码进行加密
            //2、为了保证安全，防止密码外泄
            $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
            //1、将用户填写的信息追加到数据库中
            //2、为了用户在登录时，进行比对，以及其他用户注册时，进行比对操作时使用
            $this->data[] = $_POST;
            //1、将信息写到数据库文件中
            //2、信息追加到数据库中后，需要在数据库文件中保存
            dataToFile('./data.php',$this->data);
            go('注册成功','?c=member&a=login');
        }
        //引入注册页面
        $this->view(['data'=>$this->data]);
    }

    /**
     * 1、退出操作
     * 2、退出登录状态，消除cookie值
     */
    public function logout(){
        session_unset();
        session_destroy();
        go('退出成功，滚吧~','?c=member&a=login');
    }

    /**
     * 验证码
     */
    public function code(){
        requireTool('Code');
        $code = new Code();
        $code->show();
    }

























}