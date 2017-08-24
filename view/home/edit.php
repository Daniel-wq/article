<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>文章标题</title>
    <script src="./resource/bootstrap/bootstrap/js/bootstrap.min.js"></script>
    <link href="./resource/bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./resource/css/index.css" rel="stylesheet">
</head>
<body>
<div id="formBox">
    <form action="" method="post">
        <div id='form-style1'>
            <dl>
                <dt>文章标题:</dt>
                <dd>
                    <!--在修改页面题目的位置输出修改前旧数据库中相对应$id的题目-->
                    <input style="width:100%;" type="text" name="title" value="<?php echo $data['arcdata']['title'] ?>">
                </dd>
            </dl>
            <dl>
                <dt>正文:</dt>
                <dd>
                    <!--在修改页面内容的位置输出修改前旧数据库中相对应$id的内容-->
                    <textarea style="width:100%;height:120px;" name="content"><?php echo $data['arcdata']['content'] ?></textarea>
                </dd>
            </dl>
            <dl>
                <dt></dt>
                <dd>
                    <input class='btn' type="submit" value="修改">
                </dd>
            </dl>
        </div>
    </form>
</div>
</body>
</html>