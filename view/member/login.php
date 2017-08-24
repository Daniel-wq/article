<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daniel之家</title>
    <link rel="stylesheet" href="./resource/bt/css/bootstrap.min.css">
    <script src="./resource/js/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="./resource/jquery-1.7.2.min.js"></script>
    <style>
        .parcel{
            z-index: 9;
            margin-top: 30px;
        }
        .title{
            color: deeppink;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            //获取图片原始地址
            var src = $('img').attr('src');
            //当点击"看不清换一张"和图片的时候,更改路径,随机显示验证码
            $('#change,img').click(function () {
                $('img').attr('src',src + '&t=' + Math.random());
            })
        })
    </script>
</head>

<!--注册-->
<!--点‘登陆’按钮时，跳转验证页面-->
<form class="form-horizontal" action="" method="post">
    <div class="parcel">
        <div class="form-group">
            <label class="col-sm-8 control-label" ><h2 class="title">欢迎来到Daniel之家</h2></label>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label" >用户名</label>
            <div class="col-sm-4">
                <input type="text" name='username' class="form-control" placeholder="用户名">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label" >Password</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" placeholder="Password" name='password'>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-5">
                <img src="?c=member&a=code" alt="">
                <a href="javascript:;" id="change">看不清换一张</a>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label">输入验证码</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" placeholder="验证码" name='code'>
            </div>
        </div>
        <div class="form-group">
            <div class="checkbox col-sm-offset-5">
                <label>
                    <input type="checkbox"> 7天免登陆
                </label>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-7">
                <button type="submit" class="btn btn-success col-sm-2">登陆</button>
                <a href="?c=member&a=reg" type="button" class="btn btn-info col-sm-2">注册</a>
            </div>
        </div>
    </div>
</form>
</body>
</html>