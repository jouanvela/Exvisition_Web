<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['mid']))
        header('location:index.php');
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:index.php');
    }

    //新增展覽
	if(isset($_POST['exhibition-submit'])) {
		do{
			$SQL ="SHOW TABLE STATUS WHERE Name = 'exhibition'";
			$stmt = $dbh->prepare($SQL);
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_OBJ);
			$eid = $rs->Auto_increment;
			$n = null;

			$SQL = "INSERT INTO exhibition VALUES (:mid, :eid, :eName, :eDescription, :eStartTime, :eEndTime, :eStatus)";
			$stmt = $dbh->prepare($SQL);
			$stmt->bindValue(':mid', $_SESSION['mid']);
			$stmt->bindValue(':eid', $eid);
			$stmt->bindValue(':eName', $_POST['eName']);
			$stmt->bindValue(':eDescription', $_POST['eDescription']);
			$stmt->bindValue(':eStatus', $n, PDO::PARAM_NULL);
			if($_POST['eStartTime'] != NULL)
				$stmt->bindValue(':eStartTime', $_POST['eStartTime']);
			else
				$stmt->bindValue(':eStartTime', $n, PDO::PARAM_NULL);
			if($_POST['eEndTime'] != NULL)
				$stmt->bindValue(':eEndTime', $_POST['eEndTime']);
			else
				$stmt->bindValue(':eEndTime', $n, PDO::PARAM_NULL);
			$e = $stmt->execute();
		}while(false);
		if($e)
		    echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新成功\");
		    window.location.assign(\"_list_exhibition.php\");
		    </script>
		    ";
		else
			echo $SQL;
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $title; ?></title>

        <link rel="shortcut icon" href="favicon.ico"/>
        <link rel="bookmark" href="favicon.ico"/>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet"/>
		<link href="css/style.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
			<?php include("_navdark.php");?>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8" style="text-align:left;">
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
						<div class="edit-control">
							<div class="form-group">
								<label for="eName" class="col-sm-2 control-label exhibition-title">展覽名稱</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="eName">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label exhibition-title">展覽期間</label>
								<div class="col-sm-5">
									<input type="date" class="form-control" name="eStartTime">
								</div>
								<div class="col-sm-5">
									<input type="date" class="form-control" name="eEndTime">
								</div>
							</div>
							<div class="form-group">
								<label for="eDescription" class="col-sm-2 control-label exhibition-title">展覽介紹</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="15" name="eDescription"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-1 col-sm-offset-11">
									<button type="submit" name="exhibition-submit" class="button-exvisition">新增</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>


		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>