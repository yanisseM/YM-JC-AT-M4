<?php session_start();
	include_once('BDD/connectBdd.php');

	if(isset($_POST['addLieu'])){
		$pnom = $_POST['pnom'];
		$req = $connexion->prepare('INSERT INTO port (pnom) VALUES (:pnom)');
		//$req->bindParam(':pnom', $pnom, PDO::PARAM_STR);
		$resultat = $req->execute(array('pnom'=>$pnom));
		//$resultat = $req->execute();
		if($resultat){
			$_SESSION["success"] = 'Lieu ajouté';
		}
		else{
			$_SESSION["error"] = 'Problème lors de l\'ajout d\'un lieu';
		}
		header('location: index.php?action=modifieLieu');
	}
	
	if(isset($_POST['editL'])){
		$pid = $_POST['pid'];
		$pnom = $_POST['pnom'];
		$adresse = $_POST['adresse'];
		$codePostale = $_POST['codePostale'];
		$adresse = $_POST['adresse'];
		$nlieu = $_POST['nlieu'];
				
					
		$req = $connexion->prepare('UPDATE port SET nomPort = :nom WHERE idPort = :id');
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$resultat = $req->execute();

		if($resultat){
			$_SESSION['success'] = 'Lieu modifié';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la modification du lieu';
		}
		header('location: index.php?action=modifieLieu');
	}
	
	if(isset($_POST['suprLieu'])){
		$id = $_POST['pid'];
		$req = $connexion->prepare('DELETE FROM port WHERE pid = :pid ');
		$req->bindParam(':pid', $id, PDO::PARAM_INT);
		$resultat = $req->execute();
		if($resultat){
			$_SESSION['success'] = 'lieu supprimé';
		}		
		else{
			$_SESSION['error'] = 'Problème lors de la suppression du lieu';
		}
		header('location: index.php?action=modifieLieu');
	}
?>