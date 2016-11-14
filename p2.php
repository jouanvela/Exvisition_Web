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

	if(isset($_POST['submit'])) {
		$SQL = "UPDATE member SET mName=:mName, mDescription=:description WHERE mid=:mid";
		$stmt = $dbh->prepare($SQL);
		$stmt->bindValue(':mid', $_SESSION['mid']);
		$stmt->bindValue(':mName', $_POST['mName']);
		$stmt->bindValue(':description', $_POST['description']);
		$e = $stmt->execute();

		if($e){
			$temp = preg_split("/[,]+/", $_POST['filename']);
		    foreach ($temp as $key => $value) {
		    	rename('./img/member/'.$value.'.png', './img/member/'.$_SESSION['mid'].'.png');
		    }
		    $_SESSION['mName'] = $_POST['mName'];
		    echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新成功\");
		    window.location.assign(\"p3.php\");
		    </script>
		    ";
		}
	}

	$SQL = "SELECT * FROM member WHERE mid = '".$_SESSION['mid']."'";
    $stmt = $dbh->prepare($SQL);
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);

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
		<link href="css/style.css"  rel="stylesheet"/>
	</head>

	<body class="bg-brown align-center">
		<div class="container">
			<?php include("navlight.php");?>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 col-xs-10">
					<!-- 上傳展覽 -->
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label for="mName" class="col-sm-2 control-label">
								<div class="text-light">展館名稱</div>
							</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" value="<?php echo $rs->mName; ?>" id="mName" name="mName">
							</div>
						</div>
						<div class="form-group">
							<label for="logo" class="col-sm-2 control-label">
								<div class="text-light">LOGO</div>
							</label>
							<div class="col-sm-10">
							    <input accept="image/png" type="file" id="file"/>
							    <div class="preview">
							        <br class="clearboth" style="clear:both;">
							    </div>
							    <input type="text" id="filename" name="filename" style="display:none;"/>
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="col-sm-2 control-label">
								<div class="text-light">展館介紹</div>
							</label>
							<div class="col-sm-10">
								<textarea class="form-control" rows="15" id="description" name="description"><?php echo $rs->mDescription; ?></textarea>
							</div>
						</div>
			            <button id="file_upload" class="btn btn-default">送出</button>
			            <button type="submit" id="submit" name="submit" style="display:none;" />
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>

		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/multi_upload.js"></script>
	</body>
</html>