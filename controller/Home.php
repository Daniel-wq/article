<?php

/**
 * 控制主页面的类
 * Class Home
 */
class Home extends Base {
    private $data;

    public function __construct(){

        $this->validateLogin();
        //1、载入数据库
        //2、为了下面载入数据库时可以直接调用
        $this->data = include "./arcData.php";
    }

    /**
     * //1、判断session是否存在
    //2、为了判断是否有session值存在，如果有，就直接进入首页，如果没有，就提示用户需要先去登录页面进行登录
     */
    private function validateLogin(){
        if (!isset($_SESSION['user'])){
            go('请先登录','?c=member&a=login');
        }
    }

    /**
     * 首页入口
     */
    public function entry(){

        //1、加载首页模板文件
        //2、为了在首页可以显示页面
        //3、传参是因为Base的作用域相对小，所亦需要传参（虽然可以写出来了，但是还是不是特别理解）
        $this->view(['arcdata'=>$this->data]);
    }

    /**
     * 添加文章
     */
    public function add(){
        if (IS_POST){
            //1、载入数据库
            //$data = include './data.php';
            //1、判断；2、如果输入内容有一项为空，那么就提示用户需要补全内容，并返回首页；如果题目和内容都填写了，就跳过该步，运行下面的添加代码。
            if ($_POST['title'] == '' || $_POST['content'] == ''){
                //echo "<script>alert('请填写题目或内容');location.href='?c=home&a=add'</script>";
                go('请填写题目或内容','?c=home&a=add');
            }else{
                //将post提交的数据追加进去
                //1、给post数据追加发布时刻的时间；2、为了在首页及查看页面可以显示文章发表时间。
                $_POST['time'] = date('Y-m-d H:i:s');
                //p($_POST);exit;
                //1、将新加的内容追加到数据库中；2、为了将新添加的文章保存下来。
                $this->data[] = $_POST;
                //p($data);
                //1、合法化之后重新写入数据库文件；2、为了在遍历数据库时，可以将数据库中的内容在首页及查看页面显示。
                dataToFile('./arcdata.php',$this->data);
                //1、添加成功后的成功提示，并跳回到首页
                //echo "<script>alert('添加成功');location.href='?c=home&a=entry'</script>";
                go('添加成功','?c=home&a=entry');
            }
        };
        //1、加载首页模板文件；2、为了在首页可以显示页面
        $this->view(['arcdata'=>$this->data]);
    }

    /**
     * 查看的方法
     */
    public function show(){
        //1、获得要查看项的下标；2、保证点击哪个题目查看哪个。
        $sub = $_GET['sub'];
        //p($sub);
        //1、加载查看页面模板文件；2、为了显示查看页面。
        $this->view(['arcdata'=>$this->data[$sub]]);
    }

    /**
     * 编辑的方法
     */
    public function edit(){
        //1、获得要编辑内容的下标；2、保证点击哪个题目编辑哪个。
        $sub = $_GET['sub'];
        //p($sub);
        if (IS_POST){
            //1、将修改之前数据库中的发布时间赋值给修改后的时间；2、为了保证发布时间不变。
            $_POST['time'] = $this->data[$sub]['time'];
            //1、将修改后的内容追加到以前的数据库中；2、为了将以前的内容覆盖，完成修改操作。
            $this->data[$sub] = $_POST;
            //p($data);
            //1、合法化之后重新写入数据库；2、为了在编辑之后，遍历数据库时，可以将编辑后的数据库中的内容在首页及查看页面显示。
            dataToFile('./arcdata.php',$this->data);
            //4.修改成功后的成功提示，并跳回首页
            //echo "<script>alert('编辑成功');location.href='index.php'</script>";
            go('编辑成功','?c=home&a=entry');
        }
        $oldData = $this->data[$sub];
        //1、加载编辑模板；2、为了显示编辑页面。
        $this->view(['arcdata'=>$this->data[$sub]]);
    }

    /**
     * 删除的方法
     */
    public function del(){
        //1、获得要删除项的下标；2、为了保证在数据库中找到要删除的那项。
        $sub = $_GET['sub'];
        //p($id);
        //1、在数据库中将下标为$sub的项删除
        unset($this->data[$sub]);
        //1、合法化之后重新写入数据库；2、为了在编辑之后，遍历数据库时，可以将删除后的数据库中的内容在首页及查看页面显示。
        dataToFile('./arcdata.php',$this->data);
        //4.删除成功后的成功提示
        //echo "<script>alert('删除成功');location.href='index.php'</script>";
        go('删除成功','?c=home&a=entry');
    }















}











































