<?php
function base()
 {
 $dbhost = "localhost";
 $dbuser = "test";
 $dbpass = "rtlry";
 $db = "test";
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname='.$db.';charset=utf8', $dbuser, $dbpass);
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}
	/*if (isset($_GET["id"])){
		$bdd->query("DELETE FROM todos WHERE id=".$_GET["id"]."");
	}*/
	
	if (isset($_POST["tache"])){
        $insert = $bdd->prepare("INSERT INTO todos (texte) VALUES (?)");
        $insert->bindParam(1,$tache);
        $tache = $_POST['tache'];
        $insert->execute();
	}
	
	$reponse = $bdd->query('SELECT * FROM todos');
	
	while ($donnees = $reponse->fetch())
	{
        $id = $_GET["id"];
		echo "<li><a id=\"croix\" href=\"#\" onclick=\"supprimer($id)\">x</a>   ".$donnees['texte']."</li><br/>";
    }
}
?>
<script>
    function supprimer(id) {
        var requete = new XMLHttpRequest();
        requete.open('DELETE', "http://localhost/todo/index.php?id="+id, true);
        requete.onload = function() {
            
        };
        requete.send();
    };
</script>
<html>
	<head>
		<style>
			#croix{
				color:white;
				text-decoration:none;
				right:5%;
				background-color:red;
				padding-right:5px;
				padding-left:5px;
			}
			ul{
				list-style:none;
			}
		</style>
	</head>
	<body> 
		<h1>TODOO</h1>
		<form action="index.php" method="post">
					 <input type="text" name="tache"/>
					 <input type="submit" value="Ajouter">
		</form>
		<p>
			<ul>
			<?php
			base();
			?>
			</ul>
		</p>
	</body>
</html>
