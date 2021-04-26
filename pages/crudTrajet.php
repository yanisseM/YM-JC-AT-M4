<?php
	session_start();
	include_once('BDD/connectBdd.php');

?>
	
<h1 class="page-header text-center">MODIFIER Trajet</h1>
	<div class="row">
		<div class="row">
		<?php
			if(isset($_SESSION['error'])){
				echo
				"
				<div class='alert alert-danger text-center'>
					<button class='close'>&times;</button>
					".$_SESSION['error']."
				</div>
				";
				unset($_SESSION['error']);
			}
			if(isset($_SESSION['success'])){
				echo
				"
				<div class='alert alert-success text-center'>
					<button class='close'>&times;</button>
					".$_SESSION['success']."
				</div>
				";
				unset($_SESSION['success']);
			}
		?>
		</div>
		<div class="row">
			<a href="#addnewT" data-toggle="modal" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Ajouter</a>
		</div>
		<div class="height10">
		</div>
	</div>	
		
	<div class="row">
		<table id="myTable" class="table table-bordered table-striped">
			<thead>
                <th> id du trajet </th>
				<th> id du port de départ </th>
                <th> id du port d'arrivée </th>
                <th> Action </th>
			</thead>
			<tbody>
            <?php
            
            include_once('BDD/connectBdd.php');
            $SQL = "SELECT * from trajet ";
			//$SQL="SELECT port.id as 'id', port.nom as 'nom' ,adresse, codePostale, ville , lieu.nom as 'lnom',trajet.id_Port as 'id_Port',trajet.id_Port_Arrivee as 'id_Port_Arrivee' FROM lieu INNER JOIN port ON port.id_Lieu = lieu.id  INNER JOIN trajet on trajet.id_Port AND trajet.id_Port_Arrivee";

            //$SQL = "SELECT port.id as 'pid', port.nom as 'pnom' ,adresse, codePostale, ville , lieu.nom as 'lnom' FROM lieu INNER JOIN port ON port.id_Lieu = lieu.id            ";
            //$SQL= 'SELECT * FROM lieu INNER JOIN port ON port.idLieu = lieu.idLieu ';
			$stmt = $connexion->prepare($SQL);
            $stmt->execute(array()); // on passe dans le tableaux les paramètres si il y en a à fournir (aucun ici)
            $lieu = $stmt->fetchAll();
            //var_dump($lieu); // on affiche le contenu de la variable $consoles (ici un tableau php array())
            foreach ($lieu as $row){ 
                echo 
                "<tr>
					<td>".$row['id']."</td>
                    <td>".$row['id_Port']."</td>
                    <td>".$row['id_Port_Arrivee']."</td>
                    <td><a href='#editT_".$row['id']."' class='btn btn-success btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-edit'></span> Modifier</a></td>
					<td><a href='#deleteT_".$row['id']."' class='btn btn-danger btn-sm' data-toggle='modal'><span class='glyphicon glyphicon-trash'></span> Supprimer</a></td>
                </tr>";
                include('crudTrajet/edit_delete_modal.php');
            }
        ?>
			</tbody>
		</table>
	</div>

<?php include('crudTrajet/add_modal.php') ?>

<script src="jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="datatable/jquery.dataTables.min.js"></script>
<script src="datatable/dataTable.bootstrap.min.js"></script>
<!-- generate datatable on our table -->
<script>
$(document).ready(function(){
	//inialize datatable
    $('#myTable').DataTable();

    //hide alert
    $(document).on('click', '.close', function(){
    	$('.alert').hide();
    })
});
</script>
