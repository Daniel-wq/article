<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>文章展示</title>
	<link rel="stylesheet" href="./resource/bt/css/bootstrap.min.css">
	<link href="./resource/bootstrap/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<style>
		.con{
			/*height: 44px;*/
			/*border: 1px solid black;*/
			width: 120px;
			height: 45px;
			/*多行溢出隐藏现省略号*/
			/*注:只有谷歌好用*/
			/*设置盒子*/
			display: -webkit-box;
			/*控制行数*/
			-webkit-line-clamp: 2;
			/*让他竖着排列*/
			-webkit-box-orient: vertical;
			overflow: hidden;
			/*强制不换行*/
			/*white-space: nowrap;*/
			/*溢出部分用省略号代替*/
			text-overflow: ellipsis;
		}
	</style>
</head>
<body>
<div class="container" style="margin-top: 20px;margin-bottom: 50px;">
	<div class="panel panel-info">
		<!-- Default panel contents -->
		<div class="panel-heading">文章展示
            <div style="float: right">
            欢迎尊贵的 <?php echo $_SESSION['user']['username']?> 荣耀归来
            <a href="javascript:if(confirm('确定退出吗？'))location.href='?c=member&a=logout&sub=<?php echo $k?>'" class="btn btn-danger btn-xs">退出</a>
        </div>
    </div>


		<!-- Table -->
		<table class="table table-hover">
			<tr>
				<td>编号</td>
				<td>题目</td>
				<td>内容</td>
				<td>发布时间</td>
				<td>操作</td>
			</tr>
			<tr>
				<!--1、定义用来编号的变量$i；2、为了后面删除信息时，保证编号的连续性-->
				<?php $i = 0; ?>
                <!--1、遍历数据库，获得键值；2、为了下面获得数组中的相应的内容-->
				<?php foreach($data['arcdata'] as $k=>$v){ ?>
				<!--1、让变量自增；2、为了在每增加或删除信息后，保证编号的连续性-->
				<?php $i++ ?>
				<!--1、在对应的编号位置输出相应的内容2、为了在页面中显示编号-->
				<td><?php echo $i ?></td>
				<!--1、在对应的题目位置输出相应的内容2、为了在页面中显示题目-->
				<td><a class='link' href="?c=home&a=show&sub=<?php echo $k?>"><?php echo $v['title']?></a></td>
				<!--1、在对应的内容位置输出相应的内容2、为了在页面中显示内容-->
				<td class="con"><?php echo $v['content']?></td>
				<!--1、在对应的发布时间位置输出相应的内容2、为了在页面中显示发布时间-->
				<td><?php echo $v['time']?></td>
				<td>
					<!--1、将参数$k传给id,用于类中调用；2、为了获得相应的get地址-->
					<a href="?c=home&a=edit&sub=<?php echo $k?>" class="btn btn-primary btn-xs">编辑</a>
					<!--1、弹出窗口再次确认用户是否删除；2、给用户再次确认的机会，避免用户误点删除按钮，删除必要的信息-->
					<!--1、将参数$k传给id,用于类中调用；2、为了获得相应的get地址-->
					<a href="javascript:if(confirm('确定删除吗？'))location.href='?c=home&a=del&sub=<?php echo $k?>'" class="btn btn-danger btn-xs">删除</a>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>


	<div class="pagination pagination-centered">
		<ul class="page">

			<li ><a href="?c=home&a=add">添加文章</a></li>
		</ul>
	</div>
</div>





</body>
</html>