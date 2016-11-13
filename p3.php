<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Exvisition</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css"  rel="stylesheet"/>

	</head>
	<style type="text/css">
		td{height:55px;background-color: #9C856E;padding:8px;}
	</style>
	<body class="align-center">
		<div class="container">
			<?php include("navdark.php");?>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<!-- 放廠商的logo -->
					<img src="" style="width: 520px; height: 180px;border-width:3px;"><p>(放廠商的logo)</p>
					<!-- 新增展覽 -->
					<form class="form-inline" role="form">
					  <div class="form-group">
					    <div class="input-group">
					      <label class="sr-only" for="InputExhibition">新增展覽</label>
					      <input type="text" class="form-control" id="InputExhibition">
					    </div>
					  </div>
					  <button type="submit" class="btn btn-default">+新增展覽</button>
					</form>
					<br><br>
					<!-- 新增展覽之後，在下方新增區塊 -->
					<div class="row">
						<div class="col-md-12 col-xs-12">
							<table>
								<tr>
									<!-- 日期 -->
									<td style="width:200px;" align='left' valign="bottom">
										<font color="white" face="thin">年/月/日</font>
									</td>
									<!-- 展覽名稱 -->
									<td style="width:300px;letter-spacing: 5px" align='center' valign="middle">
										<font color="white" face="thin">展覽名稱</font>
									</td>
									<!-- 編輯刪除 -->
									<td style="width:200px;" align='right' valign="middle">
										<a href=""></a>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<!-- -->


				</div>
				<div class="col-md-3"></div>
			</div>
		</div>


		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>