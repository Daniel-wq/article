<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>显示文章</title>
    <script src="./resource/bootstrap/bootstrap/js/bootstrap.min.js"></script>
    <link href="./resource/bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./resource/css/index.css" rel="stylesheet">
</head>
<body>
<div class='article'>
    <a href='?c=home&a=entry'>返回首页</a>
    <!--在显示页面题目的位置输出数据库中相对应$id的题目-->
    <h3><?php echo $data['arcdata']['title']?></h3>
    <div>
        <!--在显示页面时间的位置输出数据库中相对应$id的时间-->
        <p class='time'>发布于：<em><?php echo $data['arcdata']['time'] ?></em></p>
        <!--在显示页面内容的位置输出数据库中相对应$id的内容-->
        <p class='content'><?php echo $data['arcdata']['content'] ?></p>
    </div>
    <!--点击编辑按钮，跳转到相应的编辑页面-->
<!--    <a href='?c=home&a=edit&sub=--><?php //echo $sub?><!--'>编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
<!--    <a href="javascript:if(confirm('确定删除吗？'))location.href='?id=del&sub=--><?php //echo $sub?><!--'">删除</a>-->
</div>
</body>
</html>