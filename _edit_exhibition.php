<?php
    include("db.php");
    session_start();
    if(!isset($_SESSION['mid']))
        header('location:index.php');
    else if(isset($_GET['log']) && ($_GET['log']=='out')){
        session_destroy();
        header('location:index.php');
    }

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
		    window.location.assign(\"_list_exhibition.php\");
		    </script>
		    ";
		}
		else{
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新失敗\");
		    </script>
		    ";
		}
	}
	else if(isset($_POST['item-submit'])) {
		$picture = 0;
		$audio = 0;
		$video = 0;
		if($_FILES["picture"]["error"] == 0){
			$dir = "./img/".$_POST['iid']."/";
			if(!is_dir($dir)){
				mkdir($dir, 0777, true);
				chmod($dir, 0777);
			}
			$ext = pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION);
			move_uploaded_file($_FILES["picture"]["tmp_name"], $dir.$_SESSION['mid'].'.'.$ext);
			$picture = 1;
		}
		else if($_FILES["picture"]["error"] > 0 && $_FILES["picture"]["error"] != 4){
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"Upload Error: ".$_FILES["file"]["error"]."\");
		    window.location.assign(\"_editprofile.php\");
		    </script>
		    ";
		}
		$SQL = "UPDATE item SET iName=:iName, iDescription=:iDescription, picture=:picture, audio=:audio, video=:video, game=:game WHERE iid=:iid";
		$stmt = $dbh->prepare($SQL);
		$stmt->bindValue(':iid', $_POST['iid']);
		$stmt->bindValue(':iName', $_POST['iName']);
		$stmt->bindValue(':iDescription', $_POST['iDescription']);
		$stmt->bindValue(':game', $_POST['']);
		$e = $stmt->execute();
		if($e){
		    echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新成功\");
		    </script>
		    ";
		}
		else{
			echo "
		    <script type=\"text/javascript\">
		    window.alert(\"更新失敗\");
		    </script>
		    ";
		}
	}
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
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?php echo $title; ?></title>

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
					<form class="form-horizontal">
						<div id="edit-control">
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
									<textarea class="form-control" rows="15" id="eDescription" name="eDescription"><?php echo $eDesc; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-1 col-sm-offset-11">
									<button type="submit" id="exhibition-submit" name="exhibition-submit" class="button-exvisition">更新</button>
								</div>
							</div>
							<div class="form-group" style="margin-bottom: 0px;">
								<label for="" class="col-sm-2 control-label exhibition-title">展品清單</label>
							</div>
						</div>
					</form>
					<div class="item-list-box">
						<!-- 新增展品 -->
						<div id="add-exhibition">
							<a href="_edit_exhibition.php" class="button-exvisition">新增展品</a>
						</div>
<?php
    $SQL = "SELECT * FROM item WHERE eid ='".$eid."'";
   	$stmt = $dbh->prepare($SQL);
    $stmt->execute();
	while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
		echo '
			<div class="item-box">
				<div class="col-md-11 name">'.$rs->iName.'</div>
				<div class="col-md-1 edit">
		 			<a href="#" data-toggle="modal" data-target="#myModal'.$rs->iid.'"><span class="glyphicon glyphicon-pencil"></span></a>
		 			<a href="#"><span class="glyphicon glyphicon glyphicon-trash"></span></a>
		 		</div>
		';
		echo '
		    	<form class="form-horizontal">
				<div class="modal fade" id="myModal'.$rs->iid.'" tabindex="-1" role="dialog" aria-labelledby="myModal'.$rs->iid.'Label">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModal'.$rs->iid.'Label">標題</h4>
							</div>
							<div class="modal-body">
								<div id="edit-control">
									<input type="hidden" name="iid" value="'.$rs->iid.'"/>
									<div class="form-group">
										<label for="iName" class="col-sm-3 control-label item-title">展品名稱</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="iName" name="iName" value="'.$rs->iName.'">
										</div>
									</div>
									<div class="form-group">
										<label for="iDescription" class="col-sm-3 control-label item-title">展品介紹</label>
										<div class="col-sm-9">
											<textarea class="form-control" rows="15" id="iDescription" name="iDescription">'.$rs->iDescription.'</textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="picture" class="col-sm-3 control-label item-title">展品圖片</label>
										<div class="col-sm-9">
										    <input accept="image/jpeg" type="file" id="picture" name="picture"/>
										</div>
									</div>
									<div class="form-group">
										<label for="audio" class="col-sm-3 control-label item-title">語音導覽</label>
										<div class="col-sm-9">
										    <input accept="audio/mp3" type="file" id="audio" name="audio"/>
										</div>
									</div>
									<div class="form-group">
										<label for="video" class="col-sm-3 control-label item-title">影片介紹</label>
										<div class="col-sm-9">
										    <input accept="video/mp4" type="file" id="video" name="video"/>
										</div>
									</div>
									<div class="form-group" id="selectGame">
										<label for="" class="col-sm-3 control-label item-title">選擇遊戲</label>
										<div class="col-sm-9">
											<select class="form-control" id="game">
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
								<!-- <button type="button" class="button-exvisition" data-dismiss="modal">Close</button> -->
								<button type="submit" class="button-exvisition">儲存</button>
							</div>
						</div>
					</div>
				</div>
				</form>
			</div>
		';
	}
 ?>
						<!-- 新增展品之後，在下方新增區塊 -->
				    	<div class="item-box">
					    	<div class="col-md-11 name">一、生命的起源</div>
					    	<div class="col-md-1 edit">
					    		<a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil"></span></a>
					    		<a href="#"><span class="glyphicon glyphicon-trash"></span></a>
					    	</div>
					    	<!-- Modal -->
					    	<form class="form-horizontal">
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">標題</h4>
										</div>
										<div class="modal-body">
											<div id="edit-control">
												<div class="form-group">
													<label for="iName" class="col-sm-3 control-label item-title">展品名稱</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" id="iName" name="iName" value="'.$rs->iName.'">
													</div>
												</div>
												<div class="form-group">
													<label for="iDescription" class="col-sm-3 control-label item-title">展品介紹</label>
													<div class="col-sm-9">
														<textarea class="form-control" rows="15" id="iDescription" name="iDescription">'.$rs->iDescription.'</textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="picture" class="col-sm-3 control-label item-title">展品圖片</label>
													<div class="col-sm-9">
													    <input accept="image/jpeg" type="file" id="picture" name="picture"/>
													</div>
												</div>
												<div class="form-group">
													<label for="audio" class="col-sm-3 control-label item-title">語音導覽</label>
													<div class="col-sm-9">
													    <input accept="audio/mp3" type="file" id="audio" name="audio"/>
													</div>
												</div>
												<div class="form-group">
													<label for="video" class="col-sm-3 control-label item-title">影片介紹</label>
													<div class="col-sm-9">
													    <input accept="video/mp4" type="file" id="video" name="video"/>
													</div>
												</div>
												<div class="form-group" id="selectGame">
													<label for="" class="col-sm-3 control-label item-title">選擇遊戲</label>
													<div class="col-sm-9">
														<select class="form-control" id="game">
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
											<!-- <button type="button" class="button-exvisition" data-dismiss="modal">Close</button> -->
											<button type="submit" id="item-submit" name="item-submit" class="button-exvisition">儲存</button>										</div>
									</div>
								</div>
							</div>
							</form>
				    	</div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>


		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/game.js"></script>
	</body>
</html>