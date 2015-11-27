<!DOCTYPE html>
<html>
<head>
	<title>邮件</title>
	<meta charset="utf-8">
	<style>
	#box{
		width: 500px;
		height: 500px;
		
		margin: auto;
		padding: 10px;

		border: 2px solid gray;
		border-radius:10px;		/*圆角*/
		opacity:1;			/*不透明度*/
                text-align: center;

	}
        body{
            font-family: 微软雅黑;
        }
	</style>
</head>
<body>
<div id="box" >
您好 {{$recvName}}

您已经请求激活，可以点击下面的链接来激活<br>

复制链接到地址栏跳转到网站 ： <?php echo $checkLink; ?>

如果你没有请求重置密码，请忽略这封邮件<br>

在你点击上面链接修改密码之前，你的密码将会保持不变。<br>

</div>
</body>
</html>
