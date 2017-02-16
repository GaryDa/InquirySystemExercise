<?php
//開啟session
session_start();
//問喉使用者
echo "管理者 ".$_SESSION["userid"]." 您好 "."<br>";

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

//顯示詢價清單編號
function showListID()
{
	$link = linkDB();//呼叫連結資料庫function
	$query = "select listid from inquires";
	$result = mysqli_query($link,$query);

	if ($result) 
	{
		$count = mysqli_num_rows($result);

		for ($i=0; $i < $count ; $i++) 
		{ 
			list($listid) = mysqli_fetch_row($result);
			echo '<option>'.$listid.'</option>';
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
	$query = "select * from inquires";
	$result = mysqli_query($link,$query);

	if ($result) 
	{
		$count = mysqli_num_rows($result);
		for ($i=0; $i < $count ; $i++) 
		{ 
			$row = mysqli_fetch_row($result);
			switch ($row[5]) 
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

//將報價資料更新到詢價單上	
	$link = linkDB();
	//將報價寫入並將progress 從預設的0 改為 1 表示己報完價的狀態
	$sql = "update inquires set price = $_POST[price],progress= 1 where listid = $_POST[listID]";
	$mysql = mysqli_query($link,$sql);
	if ($mysql)
	{
		echo "報價成功";
	}
	else
	{
		echo "等待更新";
	}
?>

<html>
	<head><title>管理頁面</title></head>
	<body>
		<div class="body" align="center">
		<h1>顧客詢價清單</h1>
		<!-- 填寫報價欄 -->
		<form name="report" action="" method="post" >
			<label>清單編號： </label>
			<select name="listID"> <?php showListID(); ?></select>
			<label>報價： </label><input name="price" type="number"> 
			<input type="submit" value="報價送出" onclick="if(confirm('報價確認無誤？')) this.form.submit();">
		</form>
		<table>
			<!-- 顯示詢價單欄位標題 -->
			<tr>
				<th>清單編號<th>產品名稱<th>產品編號<th>數量<th>價格<th>處理進度<th>詢價人<th>日期
			</tr>
			<!-- 呼叫showList方法來顯示詢價單-->
			<?php showList(); ?> 
		</table>
		</div>
	</body>
</html>