<?php		

$friend = "INSERT INTO lien(idUtilisateur1, idUtilisateur2, etat) VALUES(?, ?, ?)";
$query = $pdo->prepare($friend);
$query->execute(array($_SESSION['id'],$_GET['id'],1));

//header("Location:index.php?action=profil");