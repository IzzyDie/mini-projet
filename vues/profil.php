<?php
if(isset($_SESSION['id'])){
    if(!isset($_GET['id'])){
        $id = $_SESSION['id'];
    } else {
        $id = $_GET['id'];
	}
		

        $sql = "SELECT * FROM user WHERE id=?";
        $q = $pdo->prepare($sql);
        $q->execute([$id]);

		$line = $q->fetch();
			$idFriend = $line['id'];
            $login = $line['login'];
            $avatar = $line['avatar'];
            echo "<div id='login'> Pseudo : ".$login."</div>";
            echo "<div id='avatar'> avatar : <img src='".$avatar."' alt='".$avatar."' /></div>";
			
			$friend = "SELECT * FROM lien WHERE idUtilisateur1=? OR idUtilisateur2=?";
			$query = $pdo->prepare($friend);
			$query->execute(array($_SESSION['id'],$_SESSION['id']));
			
			$data = $query->fetchAll();

				// ------------------------------------------------------------	
				// ------------------------------------------------------------	
				// -------------------------AJOUT AMIS-------------------------	
				// ------------------------------------------------------------	
				// ------------------------------------------------------------

			if($_SESSION['id'] != $_GET['id']){
				echo "<a href='index.php?action=add&id=".$idFriend."'>Ajouter en ami</a>";
			} else {

				// ------------------------------------------------------------	
				// ------------------------------------------------------------	
				// -------------------------LISTE AMIS-------------------------	
				// ------------------------------------------------------------	
				// ------------------------------------------------------------

				echo "<h2> Liste Amis: </h2>";
				
					for ($i=0; $i < sizeof($data); $i++) {

						if($data[$i]['idUtilisateur1'] == $_SESSION['id']) {
							
							echo $data[$i]['idUtilisateur2']."<a href='index.php?action=deletefriend&id=".$data[$i]['id']."'> Supprimer</a>";
							
							if($data[$i]['etat'] == true){
								echo " (en attente être accepté)";
							} 

						} else {

							if($data[$i]['etat'] == false){

								echo $data[$i]['idUtilisateur1'];

							}
						}

						echo "</br>" ;

					}

				// --------------------------------------------------------------
				// --------------------------------------------------------------	
				// -------------------------DEMANDE AMIS-------------------------	
				// --------------------------------------------------------------	
				// --------------------------------------------------------------

			echo "<h2> Demande d'amis </h2>";

				for ($i=0; $i < sizeof($data); $i++) {

					if($data[$i]['etat'] == true && $data[$i]['idUtilisateur2'] == $_SESSION['id']){

						echo $data[$i]['idUtilisateur1']."<a href='index.php?action=add&id=".$data[$i]['id']."'> Accepter</a> <a href='index.php?action=deletefriend&id=".$data[$i]['id']."'> Refuser</a>";

					}

					echo "</br>" ;

				}
			}
}

             
?>