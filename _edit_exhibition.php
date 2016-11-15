<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['mid']))
        header('location:index.php');
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:index.php');
    }
    else if(isset($_GET['eid'])){
    	$SQL = "SELECT * FROM exhibition WHERE mid = '".$_SESSION['mid']."' AND eid ='".$_GET['eid']."'";
	    $stmt = $dbh->prepare($SQL);
	    $stmt->execute();
	    $rs = $stmt->fetch(PDO::FETCH_OBJ);
	    if(empty($rs->eid))
	    	header('location:_list_exhibition.php');
	    $eid = $_GET['eid'];
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
			<?php include("_navdark.php");?>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8" style="text-align:left;">
					<form class="form-horizontal">
						<div id="edit-control">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label title">展覽名稱</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="eName" value="搖擺吧！動物們 - 藝術設計展">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label title">展覽期間</label>
								<div class="col-sm-5">
									<input type="date" class="form-control" name="eStartTime">
								</div>
								<div class="col-sm-5">
									<input type="date" class="form-control" name="eEndTime">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label title">展覽介紹</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="15" id="description" name="description"></textarea>
								</div>
							</div>
							<div class="form-group" style="margin-bottom: 0px;">
								<label for="" class="col-sm-2 control-label title">展品清單</label>
							</div>
						</div>
					</form>
					<div class="item-list-box">
						<!-- 新增展品 -->
						<div id="add-exhibition">
							<a href="_edit_exhibition.php" class="button-exvisition">新增展品</a>
						</div>

						<!-- 新增展品之後，在下方新增區塊 -->

						<!-- -->
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>


		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>