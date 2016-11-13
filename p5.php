<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Exvisition</title>

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css"  rel="stylesheet"/>
	</head>
	<style type="text/css">
		td{height:55px;background-color: #9C856E;padding:8px;}
	</style>
	<body>
		<div class="container">
			<div class="row">
				<br>
				<div class="col-md-6"></div>
				<div class="col-md-6 col-xs-12" style="text-align:center;">
					<br>
					<!-- 登入後顯示xxx你好 -->
					<font color="#C1A685" face="thin">xxx你好</font>
					&nbsp<font color="#886600">|</font>&nbsp
					<!-- -->
					<a href="p3.html" class="a2">基本資料</a>&nbsp<font color="#886600">|</font>&nbsp
					<a href="" class="a2">聯絡我們</a>&nbsp<font color="#886600">|</font>&nbsp
					<a href="" class="a2">登出</a>
				</div>
				<br><br>
				<hr class="h1">
			</div>

			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 col-xs-12">
					<br><br><br><br>
					<!-- 編輯展品 -->
					<form>
						<!-- 編輯展品名稱 -->
					 	<div>
						    <label for="InputName">
						    	<font class="p5">展品名稱</font>
						    </label>
						    <input type="text" id="InputName">
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 展品圖片 -->
					  	<div>
						    <label for="pic">
						    	<font class="p5">展品圖片</font>
						    </label>
						    <br><br>
						    <input type="file" id="pic">
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 展品介紹 -->
					  	<div>
						    <label for="introduce">
						    	<font class="p5">展品介紹</font>
						    </label>
						    <br><br>
						    <textarea id="introduce"></textarea>
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 語音導覽 -->
					  	<div>
						    <label for="voice">
						    	<font class="p5">語音導覽</font>
						    </label>
						    <br><br>
						    <input type="file" id="voice">
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 影片導覽 -->
					  	<div>
						    <label for="video">
						    	<font class="p5">影片導覽</font>
						    </label>
						    <br><br>
						    <input type="file" id="video">
					  	</div>
					  	<br><br><hr class="h2"><br><br>
					  	<!-- 小遊戲 -->
						<div>
					  	<button class="game" style="vertical-align:middle" data-toggle="modal" data-target="#myModal" type="button"><span>小遊戲</span></button>
					  	<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						        <h4 class="modal-title" id="myModalLabel">選擇遊戲</h4>
						      </div>
						      <div class="modal-body">
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8 col-xs-12">
										<br>
										<!-- 選擇遊戲 -->
										<form>
										  	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
											  <div class="panel panel-default" style="border:0px white none;">
											    <div class="panel-heading" role="tab" id="headingTwo" style="background-color: white; border:0px white none; padding: 15px;">
											      <h4 class="panel-title">
											        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											        <!-- 滑塊拼圖 -->
											          <label for="puz">
													  	<font class="p6">滑塊拼圖</font>
												    </label>
											        </a>
											      </h4>
											    </div>
											    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
											      <div class="panel-body">
											      <!-- 上傳圖片 -->
											       	<input type="file" id="puz">
											      </div>
											    </div>
											  </div>
											  <div class="panel panel-default" style="border:0px white none;">
											    <div class="panel-heading" role="tab" id="headingThree" style="background-color: white; border-style: none; padding: 15px;">
											      <h4 class="panel-title">
											        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
											        <!-- 射擊遊戲 -->
											        <label for="sht">
												    	<font class="p6">射擊遊戲</font>
												    </label>
											        </a>
											      </h4>
											    </div>
											    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
											      <div class="panel-body">
											      <!-- 上傳圖片 -->
											        <input type="file" id="sht">
											      </div>
											    </div>
											  </div>
											  <div class="panel panel-default" style="border:0px white none;">
											    <div class="panel-heading" role="tab" id="headingFour" style="background-color: white; border-style: none; padding: 15px;">
											      <h4 class="panel-title">
											        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
											        <!-- 接物品 -->
											        <label for="cah">
														<font class="p6">接物品</font>
													</label>
											        </a>
											      </h4>
											    </div>
											    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
											      <div class="panel-body">
											      <!-- 上傳圖片 -->
												       <input type="file" id="cah">
											      </div>
											    </div>
											  </div>
											  <div class="panel panel-default" style="border:0px white none;">
											    <div class="panel-heading" role="tab" id="headingFive" style="background-color: white; border-style: none; padding: 15px;">
											      <h4 class="panel-title">
											        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
											        <!-- 挖礦 -->
											        <label for="a">
														<font class="p6">挖礦</font>
													</label>
											        </a>
											      </h4>
											    </div>
											    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
											      <div class="panel-body">
											      <!-- 上傳圖片 -->
												       <input type="file" id="a">
											      </div>
											    </div>
											  </div>
											  <div class="panel panel-default" style="border:0px white none;">
											    <div class="panel-heading" role="tab" id="headingSix" style="background-color: white; border-style: none; padding: 15px;">
											      <h4 class="panel-title">
											        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
											        <!-- 記憶遊戲 -->
											        <label for="mem">
														<font class="p6">記憶遊戲</font>
													</label>
											        </a>
											      </h4>
											    </div>
											    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
											      <div class="panel-body">
											      <!-- 上傳圖片 -->
											   		   <input type="file" id="mem">
											      </div>
											    </div>
											  </div>
											</div>
										  	<br>
										</form>
									</div>
									<div class="col-md-2"></div>
								</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary">確定</button>
						      </div>
						    </div>
						  </div>
						</div>
					    <br><br> 

				  	</div>
				  	
				  	<br><br><hr class="h2"><br><br>
				  	<!-- 送出 -->
				  	<div style="text-align:center;">
				  		<button type="submit" class="btn btn-default">送出</button>
					</div>
				</form>

				<div class="col-md-3"></div>
			</div>
		</div>

		<!--JavaScript-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="game.js"></script>
	</body>
</html>