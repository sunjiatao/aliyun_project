<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="/dologin" method="post">
		用户名:<input type="text" name="name"><br>
		密码:<input type="password" name="pwd"><br>
			{{csrf_field()}}
			<!-- csrf保护 -->
		<input type="submit" name="登录">
	</form>
</body>
</html>