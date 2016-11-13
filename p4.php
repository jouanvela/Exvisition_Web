<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['mid']))
    {
        header('location:index.php');
    }
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:index.php');
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Exvisition</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css" rel="stylesheet"/>
	</head>
	<style type="text/css">
		td {
			height:55px;
			background-color: #9C856E;
			padding:8px;
		}
	</style>
	<body>
		<div class="container">
			<?php include("navdark.php");?>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 col-xs-12" style="text-align:left;">
					<p>
						<font class="p3">展覽名稱</font>&nbsp&nbsp
						<!-- 顯示展覽的名稱 -->
						<font class="p3name">XXX展</font>
					</p>
					<br>
					<p class="p3">展品清單</p>
					<div style="border-width: 0.8px; border-color: black; border-style:solid; padding: 30px 16px;">
						<!-- 新增展品 -->
						<form class="form-inline" role="form">
						  <div class="form-group">
						    <div class="input-group">
						      <label class="sr-only" for="InputExhibition">新增展品</label>
						      <input type="text" class="form-control" id="InputExhibition">
						    </div>
						  </div>
						  <button type="submit" class="btn btn-default">+新增展品</button>
						</form>
						<br><br><br><br><br>
						<!-- 新增展品之後，在下方新增區塊 -->
						<table>
							<tr>
								<!--  -->
								<td style="width:200px;" align='left' valign="bottom">
								</td>
								<!-- 展覽名稱 -->
								<td style="width:300px;letter-spacing: 5px" align='center' valign="middle">
									<font color="white" face="thin">展品名稱</font>
								</td>
								<!-- 編輯刪除 -->
								<td style="width:200px;" align='right' valign="middle">
									<a href=""></a>
								</td>
							</tr>
						</table><br>
						<!-- -->
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>


		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>