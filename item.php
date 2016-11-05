<?php

	include("db.php");

    if(isset($_GET["iid"]))
        $iid = $_GET["iid"];
    else
        $iid = 1;

    $SQL = 'SELECT * FROM `item` WHERE iid = '.$iid;
    $stmt = $dbh->prepare("$SQL");
    if($stmt->execute())
    {
	    $rs = $stmt->fetch(PDO::FETCH_OBJ);
	    $iid            = $rs->iid;
	    $iName		    = $rs->iName;
	    $iDescription   = $rs->iDescription;
	    $picture        = $rs->picture;
	    $audio          = $rs->audio;
	    $video          = $rs->video;
	    $game           = $rs->game;
	    echo $iName.";".$iDescription.";".$picture.";".$audio.";".$video.";".$game;
	}
	else
		echo "Error";
?>
