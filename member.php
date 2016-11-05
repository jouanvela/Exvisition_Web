<?php

	include("db.php");

    if(isset($_GET["mid"]))
        $mid = $_GET["mid"];
    else
        $mid = 1;

    $SQL = 'SELECT * FROM `member` WHERE mid = '.$mid;
    $stmt = $dbh->prepare("$SQL");
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);

    $mid            = $rs->mid;
    $mName		    = $rs->mName;
    $mDescription   = $rs->mDescription;
    echo $mName.";".$mDescription;

?>
