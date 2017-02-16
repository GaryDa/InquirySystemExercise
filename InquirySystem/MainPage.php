<?php
//開啟session
session_start();
//問候使用者 
echo "使用者 ".$_SESSION["userid"]." "."您好！"."<br>";
echo "<br>";
echo '<a href="login.php">'.登出.'</a>';

//連結資料庫
function linkDB()
{
	$link = mysqli_connect("localhost","root","password");
	//mysqli_query("set names utf8");//
	mysqli_set_charset($link,"utf8");
	mysqli_select_db($link,"inquiry");
	return $link;//將連結回傳
}

//在下拉式選單顯示商品編號
function showProductOption()
{
	$link = linkDB();//呼叫連結資料庫function
	$query = "select productid from products";
	$result = mysqli_query($link,$query);

	if ($result) 
	{
		$count = mysqli_num_rows($result);

		for ($i=0; $i < $count ; $i++) 
		{ 
			list($productid) = mysqli_fetch_row($result);
			echo '<option>'.$productid.'</option>';
		}

		mysqli_free_result($result);
	}
	else
	{
		echo mysqli_error($link);
	}
	mysqli_close($link);
}
//顯示在商品頁面上
function showProduct()
{	
	$link = linkDB();//呼叫連資料庫function
	$query = "select * from products";
	$result = mysqli_query($link,$query);

	if ($result) 
	{
		$count = mysqli_num_rows($result);
	
		for ($i=0; $i < $count ; $i++) 
		{ 
			echo "<tr>";
			list($productname,$productid,$descript) = mysqli_fetch_row($result);
			echo '<td>'.$productname.'</td>'.'<td>'.$productid.'</td>'.'<td>'.$descript.'</td>';
			echo "</tr>";
		}
		
		mysqli_free_result($result);
	}
	else
	{
		echo mysqli_error($link);
	}
	mysqli_close($link);
}
//顯示詢價清單
function showList()
{
	$link = linkDB();
	$userid = $_SESSION["userid"];
	$query = "select * from inquires where user='$userid'";
	$result = mysqli_query($link,$query);

	if ($result) 
	{
		$count = mysqli_num_rows($result);
		for ($i=0; $i < $count ; $i++) 
		{ 
			$row = mysqli_fetch_row($result);
			switch ($row[5])//判斷progress欄位 預設0為待報價，報完價後便會變為1 
			{
				case 0:
					$row[5]="待報價";
					break;
				case 1:
					$row[5]="己報價";
					break;
				default:
					break;
			}
			echo "<tr>";
			for ($j=0; $j < count($row); $j++) 
			{ 
				echo '<td>'.$row[$j].'</td>';
			}
			echo "</tr>";
		}
		mysqli_free_result($result);
	}
	else
	{
		echo mysqli_error($link);
	}
	mysqli_close($link);


}
//將詢價單寫入資料庫	
	$link = linkDB();
	$sql = "insert into inquires (productname,productid,number,user) values('$_POST[productName]','$_POST[productID]','$_POST[number]','$_SESSION[userid]')";
	$mysql = mysqli_query($link,$sql);
	if ($mysql)
	{
		echo "成功";
	}
	else
	{
		echo "等待更新";
	}
?>

<!--Html頁面-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/><title>機車材料詢價系統首頁</title>
		<link rel="stylesheet" href="css/MainPage.css" type="text/css"/>
	</head>
	<body>
		<div class="container">
			<!-- 標題列 -->
			<div class="header">
				<h1 class="first">機車材料詢價系統</h1>
			</div>
			<!-- 全商品列表 -->
			<div class="productList">
				<h1>商品列表</h1>
				<table cellpadding="8">
					<tr>
					<th>商品名稱<th>商品編號<th>適用車型
					</tr>
					<?php showProduct(); ?>
				</table>
			</div>
			<!-- 詢價單填寫欄 -->
			<div class="inquiryForm">
			<form name="inquiry" action="" method="post" >
				<label>產品編號： </label>
				<!-- 呼叫showProductOption()顯示詢價清單編號在下拉式選單中 -->
				<select name="productID"> <?php showProductOption(); ?></select><br>
				<label>產品名稱： </label><input name="productName" type="text" placeholder="請輸入產品名稱"><br>
				<label>數量： </label><input name="number" type="number" placeholder="請輸入數量"><br> 
				<input type="submit" value="詢價送出">
			</form>
			</div>
			<!-- 詢價單列表 -->
			<div class="inquiryList">
				<h1>我的詢價清單及處理狀態</h1>
				<table border='1' cellpadding="8">
					<tr>
						<th>清單編號<th>產品名稱<th>產品編號<th>數量<th>價格<th>處理進度<th>詢價人<th>日期
					</tr>
					<!--呼叫showList()顯示商品清單-->
					<?php showList();?>
				</table>
			</div>
		</div>
	</body>
		
</html>
