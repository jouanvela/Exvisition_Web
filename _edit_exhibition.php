<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['mid']))
        header('location:index.php');
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:index.php');
    }
    //按下刪除
    else if(isset($_GET['delete'])){
    	$SQL = "SELECT * FROM item WHERE iid = ".$_GET['delete']." AND eid IN (SELECT eid FROM exhibition WHERE mid = ".$_SESSION['mid'].")";
	    $stmt = $dbh->prepare($SQL);
	    $stmt->execute();
	    $rs = $stmt->fetch(PDO::FETCH_OBJ);
	    if(!empty($rs->eid)){
		    $SQL = "DELETE FROM item WHERE iid ='".$_GET['delete']."'";
		    $stmt = $dbh->prepare($SQL);
		    $stmt->execute();
	   	}
	   	else
	   		header('location:_edit_exhibition.php?eid='.$_GET['eid']);
    }

    //修改展覽
	if(isset($_POST['exhibition-submit'])) {
		$SQL = "UPDATE exhibition SET eName=:eName, eDescription=:eDescription, eStartTime=:eStartTime, eEndTime=:eEndTime WHERE eid=:eid";
		$stmt = $dbh->prepare($SQL);
		$stmt->bindValue(':eid', $_POST['eid']);
		$stmt->bindValue(':eName', $_POST['eName']);
		$stmt->bindValue(':eDescription', $_POST['eDescription']);
		$stmt->bindValue(':eStartTime', $_POST['eStartTime']);
		$stmt->bindValue(':eEndTime', $_POST['eEndTime']);
		$e = $stmt->execute();
		if($e){
		    echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新成功\");
		    window.location.assign(\"_edit_exhibition.php?eid=".$_POST['eid']."\");
		    </script>
		    ";
		}
		else{
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新失敗\");
		    window.location.assign(\"_edit_exhibition.php?eid=".$_POST['eid']."\");
		    </script>
		    ";
		}
	}
	//修改展品
	else if(isset($_POST['item-submit'])){
		$picture = 0;
		$audio = 0;
		$video = 0;
		$dir = "./item/".$_POST['iid']."/";
		if(!is_dir($dir)){
			mkdir($dir, 0777, true);
			chmod($dir, 0777);
		}
		if($_FILES["picture"]["error"] == 0){
			$ext = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
			if(move_uploaded_file($_FILES["picture"]["tmp_name"], $dir.'picture'.'.'.$ext))
				$picture = 1;
		}
		else if($_FILES["picture"]["error"] > 0 && $_FILES["picture"]["error"] != 4){
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"Picture Upload Error: ".$_FILES["picture"]["error"]."\");
		    </script>
		    ";
		}
		if($_FILES["audio"]["error"] == 0){
			$ext = pathinfo($_FILES["audio"]["name"], PATHINFO_EXTENSION);
			if(move_uploaded_file($_FILES["audio"]["tmp_name"], $dir.'audio'.'.'.$ext))
				$audio = 1;
		}
		else if($_FILES["audio"]["error"] > 0 && $_FILES["audio"]["error"] != 4){
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"Audio Upload Error: ".$_FILES["audio"]["error"]."\");
		    </script>
		    ";
		}
		if($_FILES["video"]["error"] == 0){
			$ext = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);
			if(move_uploaded_file($_FILES["video"]["tmp_name"], $dir.'video'.'.'.$ext))
				$video = 1;
		}
		else if($_FILES["video"]["error"] > 0 && $_FILES["video"]["error"] != 4){
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"Video Upload Error: ".$_FILES["video"]["error"]."\");
		    </script>
		    ";
		}
		$SQL = "UPDATE item SET iName=:iName, iDescription=:iDescription, picture=:picture, audio=:audio, video=:video, game=:game WHERE iid=:iid";
		$stmt = $dbh->prepare($SQL);
		$stmt->bindValue(':iid', $_POST['iid']);
		$stmt->bindValue(':iName', $_POST['iName']);
		$stmt->bindValue(':iDescription', $_POST['iDescription']);
		$stmt->bindValue(':picture', $picture);
		$stmt->bindValue(':audio', $audio);
		$stmt->bindValue(':video', $video);
		$stmt->bindValue(':game', $_POST['game']);
		$e = $stmt->execute();
		if($e){
		    echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新成功\");
		    window.location.assign(\"_edit_exhibition.php?eid=".$_POST['eid']."\");
		    </script>
		    ";
		}
		else{
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新失敗\");
		    window.location.assign(\"_edit_exhibition.php?eid=".$_POST['eid']."\");
		    </script>
		    ";
		}
	}
	//新增展品
	else if(isset($_POST['add-item'])){
		do{
			$SQL ="SHOW TABLE STATUS WHERE Name = 'item'";
			$stmt = $dbh->prepare($SQL);
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_OBJ);
			$iid = $rs->Auto_increment;

			$SQL = "INSERT INTO `item` (`eid` ,`iid`, `iName`, `iDescription`, `game`) VALUES (:eid, :iid, :iName, :iDescription, :game)";
			$stmt = $dbh->prepare($SQL);
			$stmt->bindValue(':eid', $_POST['eid']);
			$stmt->bindValue(':iid', $iid);
			$stmt->bindValue(':iName', $_POST['iName']);
			$stmt->bindValue(':iDescription', $_POST['iDescription']);
			$stmt->bindValue(':game', $_POST['game']);
			$e = $stmt->execute();
		}while(!$e);

		$picture = 0;
		$audio = 0;
		$video = 0;
		$dir = "./item/".$iid."/";
		if(!is_dir($dir)){
			mkdir($dir, 0777, true);
			chmod($dir, 0777);
		}
		if($_FILES["picture"]["error"] == 0){
			$ext = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
			if(move_uploaded_file($_FILES["picture"]["tmp_name"], $dir.'picture'.'.'.$ext))
				$picture = 1;
		}
		else if($_FILES["picture"]["error"] > 0 && $_FILES["picture"]["error"] != 4){
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"Picture Upload Error: ".$_FILES["picture"]["error"]."\");
		    </script>
		    ";
		}
		if($_FILES["audio"]["error"] == 0){
			$ext = pathinfo($_FILES["audio"]["name"], PATHINFO_EXTENSION);
			if(move_uploaded_file($_FILES["audio"]["tmp_name"], $dir.'audio'.'.'.$ext))
				$audio = 1;
		}
		else if($_FILES["audio"]["error"] > 0 && $_FILES["audio"]["error"] != 4){
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"Audio Upload Error: ".$_FILES["audio"]["error"]."\");
		    </script>
		    ";
		}
		if($_FILES["video"]["error"] == 0){
			$ext = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);
			if(move_uploaded_file($_FILES["video"]["tmp_name"], $dir.'video'.'.'.$ext))
				$video = 1;
		}
		else if($_FILES["video"]["error"] > 0 && $_FILES["video"]["error"] != 4){
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"Video Upload Error: ".$_FILES["video"]["error"]."\");
		    </script>
		    ";
		}

		$SQL = "UPDATE item SET picture=:picture, audio=:audio, video=:video WHERE iid=:iid";
		$stmt = $dbh->prepare($SQL);
		$stmt->bindValue(':iid', $iid);
		$stmt->bindValue(':picture', $picture);
		$stmt->bindValue(':audio', $audio);
		$stmt->bindValue(':video', $video);
		$e = $stmt->execute();
		if($e){
		    echo "
		    <script type=\"text/javascript\">
		    window.alert(\"新增成功\");
		    window.location.assign(\"_edit_exhibition.php?eid=".$_POST['eid']."\");
		    </script>
		    ";
		}
		else{
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"新增失敗\");
		    window.location.assign(\"_edit_exhibition.php?eid=".$_POST['eid']."\");
		    </script>
		    ";
		}
	}
	//顯示
    else if(isset($_GET['eid'])){
		$SQL = "SELECT * FROM exhibition WHERE mid = '".$_SESSION['mid']."' AND eid ='".$_GET['eid']."'";
	    $stmt = $dbh->prepare($SQL);
	    $stmt->execute();
	    $rs = $stmt->fetch(PDO::FETCH_OBJ);
	    if(empty($rs->eid))
	    	header('location:_list_exhibition.php');
	    $mid   = $_SESSION['mid'];
	    $eid   = $_GET['eid'];
	    $eName = $rs->eName;
	    $eDesc = $rs->eDescription;
	    $eStartTime = $rs->eStartTime;
	    $eEndTime = $rs->eEndTime;
    }
    else
    	header("_list_exhibition.php");
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
				<div class="col-md-8">
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
						<div class="edit-control">
							<input type="hidden" name="eid" value="<?php echo $eid; ?>">
							<div class="form-group">
								<label for="eName" class="col-sm-2 control-label exhibition-title">展覽名稱</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="eName" value="<?php echo $eName; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="" class="col-sm-2 control-label exhibition-title">展覽期間</label>
								<div class="col-sm-5">
									<input type="date" class="form-control" name="eStartTime" value="<?php echo $eStartTime; ?>">
								</div>
								<div class="col-sm-5">
									<input type="date" class="form-control" name="eEndTime" value="<?php echo $eEndTime; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="eDescription" class="col-sm-2 control-label exhibition-title">展覽介紹</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="15" name="eDescription"><?php echo $eDesc; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" name="exhibition-submit" class="button-exvisition">更新</button>
							</div>
							<div class="form-group" id="item-list-title">
								<label for="" class="col-sm-2 control-label exhibition-title">展品清單</label>
							</div>
						</div>
					</form>
					<div class="item-list-box">
						<!-- 新增展品 -->
						<div id="add-exhibition">
							<a href="#" class="button-exvisition" data-toggle="modal" data-target="#add">新增展品</a>
						</div>
						<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
							<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="addLabel">新增展品</h4>
										</div>
										<div class="modal-body">
											<div class="edit-control">
											<input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">
												<div class="form-group">
													<label for="iName" class="col-sm-3 control-label item-title">展品名稱</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="iName">
													</div>
												</div>
												<div class="form-group">
													<label for="iDescription" class="col-sm-3 control-label item-title">展品介紹</label>
													<div class="col-sm-9">
														<textarea class="form-control" rows="15" name="iDescription"></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="picture" class="col-sm-3 control-label item-title">展品圖片</label>
													<div class="col-sm-9 item-text">
													    <input accept="image/jpeg" type="file" name="picture"/>
													</div>
												</div>
												<div class="form-group">
													<label for="audio" class="col-sm-3 control-label item-title">語音導覽</label>
													<div class="col-sm-9 item-text">
													    <input accept="audio/mp3" type="file" name="audio"/>
													</div>
												</div>
												<div class="form-group">
													<label for="video" class="col-sm-3 control-label item-title">影片介紹</label>
													<div class="col-sm-9 item-text">
													    <input accept="video/mp4" type="file" name="video"/>
													</div>
												</div>
												<div class="form-group selectGame">
													<label for="" class="col-sm-3 control-label item-title">選擇遊戲</label>
													<div class="col-sm-9">
														<select class="form-control game" name="game">
															<option value=""></option>
															<option value="puzzle">滑塊拼圖</option>
															<option value="memory">記憶遊戲</option>
															<option value="mining">挖礦遊戲</option>
															<option value="shooting">射擊遊戲</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="button-exvisition" data-dismiss="modal">取消</button>
											<button type="submit" class="button-exvisition" name="add-item">儲存</button>
										</div>
									</div>
								</div>
							</div>
						</form>
<?php
    $SQL = "SELECT * FROM item WHERE eid ='".$eid."'";
   	$stmt = $dbh->prepare($SQL);
    $stmt->execute();
	while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
		echo '
			<div class="item-box">
				<div class="col-md-2"></div>
				<div class="col-md-8 name">'.$rs->iName.'</div>
				<div class="col-md-2 edit">
					<a href="_QRCODE.php?iid='.$rs->iid.'" target="_blank"><span class="glyphicon glyphicon-qrcode"></span></a>
		 			<a href="#" data-toggle="modal" data-target="#myModal'.$rs->iid.'"><span class="glyphicon glyphicon-pencil"></span></a>
		 			<a href="" class="fackDelete"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
		 			<a href="?eid='.$_GET['eid'].'&delete='.$rs->iid.'" style="display:none;"></a>
		 		</div>
		';
		echo '
						<form class="form-horizontal" action="'.$_SERVER['PHP_SELF'].'" method="POST" enctype="multipart/form-data">
							<div class="modal fade" id="myModal'.$rs->iid.'" tabindex="-1" role="dialog" aria-labelledby="addLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="addLabel">編輯展品</h4>
										</div>
										<div class="modal-body">
											<div class="edit-control">
												<input type="hidden" name="iid" value="'.$rs->iid.'">
												<div class="form-group">
													<label for="iName" class="col-sm-3 control-label item-title">展品名稱</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" name="iName" value="'.$rs->iName.'">
													</div>
												</div>
												<div class="form-group">
													<label for="iDescription" class="col-sm-3 control-label item-title">展品介紹</label>
													<div class="col-sm-9">
														<textarea class="form-control" rows="15" name="iDescription">'.$rs->iDescription.'</textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="picture" class="col-sm-3 control-label item-title">展品圖片</label>
													<div class="col-sm-9 item-text">
													    <input accept="image/jpeg" type="file" name="picture"/>
													</div>
												</div>
												<div class="form-group">
													<label for="audio" class="col-sm-3 control-label item-title">語音導覽</label>
													<div class="col-sm-9 item-text">
													    <input accept="audio/mp3" type="file" name="audio"/>
													</div>
												</div>
												<div class="form-group">
													<label for="video" class="col-sm-3 control-label item-title">影片介紹</label>
													<div class="col-sm-9 item-text">
													    <input accept="video/mp4" type="file" name="video"/>
													</div>
												</div>
												<div class="form-group selectGame">
													<label for="" class="col-sm-3 control-label item-title">選擇遊戲</label>
													<div class="col-sm-9">
														<select class="form-control game" name="game">
															<option value=""></option>
															<option value="puzzle">滑塊拼圖</option>
															<option value="memory">記憶遊戲</option>
															<option value="mining">挖礦遊戲</option>
															<option value="shooting">射擊遊戲</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="button-exvisition" data-dismiss="modal">取消</button>
											<button type="submit" class="button-exvisition" name="item-submit">儲存</button>
										</div>
									</div>
								</div>
							</div>
						</form>
			</div>
		';
	}
 ?>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>


		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/game.js"></script>
		<script src="js/delete.js"></script>
	</body>
</html>