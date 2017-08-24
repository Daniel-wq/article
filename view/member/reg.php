<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注册</title>
    <link rel="stylesheet" href="./resource/bt/css/bootstrap.min.css">
    <style>
        body{
            background: url("./24.jpg");
        }
        .parcel{
            z-index: 9;
            margin-top: 100px;
        }
        .title{
            color: deepskyblue;
        }
    </style>
</head>

<!--注册-->
<form class="form-horizontal" action="" method="post">
    <div class="parcel">
        <div class="form-group">
            <label class="col-sm-8 control-label" ><h2 class="title">欢迎来到注册页面</h2></label>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-7">
                <a href="?c=member&a=login" class="btn btn-primary col-sm-4">返回首页</a>
            </div>
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
            <div class="col-sm-offset-7">
                <button type="submit" class="btn btn-primary col-sm-3">注册</button>
            </div>
        </div>
    </div>
</form>
</body>
</html>