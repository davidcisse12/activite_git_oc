<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
		<title>Mini Chat</title>
		</head>
		<style type="text/css">
		    h1, h3
		    {
		        text-align:center;
			}
			h3
			{
			    background-color:black;
			        color:white;
				    font-size:0.9em;
				        margin-bottom:0px;
					}
					.news p
					{
					    background-color:#CCCCCC;
					        margin-top:0px;
						}
						.news
						{
						    width:70%;
						        margin:auto;
							}

							a
							{
							    text-decoration: none;
							        color: blue;
								}

								</style>
								<body>

								<?php
								// On se connecte a la base de donnée
								try {
									$bdd = new PDO('mysql:host=localhost;dbname=testop;charset=utf8', 'root', '');
									}
									//en cas d'erreur, on affiche un message et on arrète tout
									catch (Excepion $e)
									{
										die('Erreur : '.$e->getMessage());
										}

										//on récupère le commentaire
										$req = $bdd->prepare('SELECT id,titre,contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y %Hh%imin%ss\') AS date_cr FROM billets WHERE id= :commentairesid');
										$req->execute(array('commentairesid' => $_GET['commentairesid']));

										//on affiche chaque entrée une à une
										while ($donnees = $req->fetch()) {
										echo '<div class="news">';
										echo '<h3>'. htmlspecialchars($donnees['titre']) .' '.$donnees['date_cr'].'</h3>';
										echo '<p>'. htmlspecialchars($donnees['contenu']) .'</p>';
										echo '</div>';
										}

										$req->closeCursor();

										$reqcom = $bdd->prepare('SELECT auteur,commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y %Hh%imin%ss\') AS date_com FROM commentaires WHERE id_billet = :commentairesid');
										$reqcom->execute(array('commentairesid' => $_GET['commentairesid']));

										//on affiche chaque entrée une à une
										echo '<h1>Commentaires</h1>';
										while ($donnees = $reqcom->fetch()) {
										echo '<div>';
										echo '<p><b>'. htmlspecialchars($donnees['auteur']) .'</b> '.$donnees['date_com'].'</p>';
										echo '<p>'. htmlspecialchars($donnees['commentaire']) .'</p>';
										echo '</div>';
										}

										$reqcom->closeCursor();

										?>

										</body>
										</html>
