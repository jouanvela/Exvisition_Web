<?php

	include("db.php");

    if(isset($_GET["eid"]))
        $eid = $_GET["eid"];
    else
        $eid = 1;

    $SQL = 'SELECT * FROM `exhibition` WHERE eid = '.$eid;
    $stmt = $dbh->prepare("$SQL");
    $stmt->execute();
    $rs = $stmt->fetch(PDO::FETCH_OBJ);

    $eid            = $rs->eid;
    $eName		    = $rs->eName;
    $eDescription   = $rs->eDescription;
    echo $eName.";".$eDescription;;

?>
