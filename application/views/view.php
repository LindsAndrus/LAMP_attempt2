<html>
<head>
	<title>Login and Registration</title>
	<style type="text/css">
		#log{display: inline-block; width: 300px; margin-left: 50px;}
		#reg{display: inline-block; width: 300px; vertical-align: top;}
	</style>
</head>
<body>
	<div id="reg">
		<h2>Register</h2>
		<form action="/registration" method="post">
			Name:<input type="text" name="first_name"><br>
			Username:<input type="text" name="username"><br>
			*Password should be at least 8 characters
			Password:<input type="password" name="password"><br>
			Confirm Password:<input type="password" name="confirm"><br>
			Date Hired:<input type="date" name="hiredate"><br>
			<input type="submit" value="Register"><br>
		</form>
	</div>
	<?php echo $errors; ?>
	<div id="log">
		<h2>Login</h2>
		<form action="/login" method="post">
			Username:<input type="text" name="member_username"><br>
			Password:<input type="password" name="member_password"><br>
			<input type="submit" value="Login"><br>
		</form>
	</div>
</body>
</html>