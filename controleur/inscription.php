<!doctype html>
<html lang="fr">
<?php
session_start();
include_once('BDD/connectBdd.php');
?>
 
<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="skin/favicon.ico" />
    <link rel="icon" href="skin/favicon_anime.gif" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="robots" content="index,follow,all" />
    <title><?php echo $title; ?></title>
    
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="datatable/dataTable.bootstrap.min.css">
 
</head>
 
<body>
 
    <div align="center"> 
    <h1> Inscription </h2> 
    <br/> 
    <form method="POST" action=""> 
 
    <table>
    <tr>
    <td align="right">
        <label for="pseudo">Pseudo : </label>
    </td>
    <td>
    <input type="text" placeholder ="Votre pseudo" id="pseudo" name ="pseudo" /> 
    </td>
    </tr>
    <tr>
        <td align="right">
        <label for="mail">Mail : </label>
        </td>
    <td>
    <input type="email" placeholder ="Votre mail" id="mail" name ="email" /> 
    </td>
    </tr>
    <tr>
        <td align="right" >
        <label for="password">Mot de passe : </label>
        </td>
    <td>
    <input type="password" placeholder ="Votre mot de passe" id="pass" name ="pass" /> 
    </td>
    </tr>
    <tr>
        <td align="right">
        <label for="password2">Confirmation mot de passe : </label>
    </td>
    <td>
    <input type="password" placeholder ="Confirmation du mot de passe" id="pass" name ="password2" /> 
        </td>
    </tr>
    </table> 
    </br>
    <button type="submit" name="addI" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Inscription</a>

</body>
</html>

<?php 
// Vérification de la validité des informations
if(isset($_POST['addI'])){
// Hachage du mot de passe
$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$pseudo = $_POST['pseudo'];
$email = $_POST['email'];

$req = $connexion->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
$resultat=$req->execute(array(
    'pseudo' => $pseudo,
    'pass' => $pass_hache,
    'email' => $email));

    if($resultat){
        $_SESSION["success"] = 'Trajet ajouté';
    }
    else{
        $_SESSION["error"] = 'Problème lors de l\'ajout du trajet';
    }
    //header('location: index.php?action=modifieTrajet');
}