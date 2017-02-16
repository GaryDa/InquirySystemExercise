<?php
session_start();
//接收submit 過來的 帳號、密碼資訊
$id = $_POST["id"];
$pw = $_POST["password"];
$type = $_POST["usertype"];

if ( (isset($id)) && (isset($pw)) && (isset($type))) 
{
	//連結資料庫比對使用者
	$link = mysqli_connect("localhost","root","password");
	mysqli_set_charset($link,"utf8");
	mysqli_select_db($link,"inquiry");
	$query = "select * from Users where id='$id'";
	$config = mysqli_query($link,$query);
	if ($config) 
	{
		list($ID,$PW,$TYPE) = mysqli_fetch_row($config);
		if ($id==$ID && $pw==$PW) 
		{
			$_SESSION["userid"]= $id;
			//照usertype欄位來分別管理者和客戶，再用header導向頁面
			if ($TYPE=="Admin") 
			{
				$_SESSION["usertype"] = $type;
				header('Location:Admin.php');
			}
			else
			{
				$_SESSION["usertype"] = $type;
				header('Location:MainPage.php');
			}
		}
		else 
		{
			echo "<script>alert('帳號或密碼錯誤');</script>";
		}
	}
	else
	{
		echo mysqli_error($link);
	}
	mysqli_close($link);
}
else
{
	//echo "<p align='center'>".請輸入完整的帳號及密碼資訊並選擇登入身份."</p>";
}

?>


<!--html區塊-->
<!DOCTYPE html>
<html>
	<head>
		<meta content='text/html; charset=UTF-8' http-equiv='Content-Type'/>
		<link rel="stylesheet" type="text/css" href="css/login.css"></head>
	<body>
		<div class="container">		
			<div class="header"><h1>詢價系統</h1></div>
			<div class="content">
				<form name="login" action ="" method ="post">
				<label>帳號：</label><input name="id" type="text" placeholder="請輸入帳號" autofocus><br>
				<br>
				<label>密碼：</label><input name="password" type="password" placeholder="請輸入密碼"><br>
				<br>
				<input name="usertype" type="radio" checked="true" value="customer">客戶
				<input name="usertype" type="radio" value="admin">管理者
				<input type="submit" value="登入"/>
				</form>
				<!-- 登入用帳號、密碼-->
				<p>管理員帳號:Admins 密碼:root</p>
				<p>客戶1帳號:Gary 密碼:abc123</p>
				<p>客戶2帳號:Jack 密碼:def123</p>
			</div>
		</div>
	</body>
	<footer><p>Copyright &copy 2017 Gary</p></footer>
</html>