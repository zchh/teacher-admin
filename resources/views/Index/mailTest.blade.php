<!DOCTYPE html>
<html>
<head>
	<title>背景图片技巧</title>
	<meta charset="utf-8">
	<style>
	#box{
		width: 500px;
		height: 500px;
		background:url(3.jpg);
		background-size:100% 100%;
		background-repeat:no-repeat;
		margin: auto;
		padding: 10px;
		
		background-origin:padding-box;/* content-box */

		border: 1px solid gray;
		border-radius:10px;		/*圆角*/
		opacity:0.5;			/*不透明度*/

	}
	</style>
</head>
<body>
<div id="box" >哈哈哈哈哈哈哈哈</div>
</body>
</html>