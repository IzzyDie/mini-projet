<?php

$id = $_GET["id"];

if($_GET['action'] == "deletefriend"){
$requete="DELETE FROM lien WHERE id=".$_GET['id']."";
$q = $pdo->prepare($requete);
$q->execute([$id]);
}
 
?>