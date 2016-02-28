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

										//on récupère les 10 derniers messages
										$reponse = $bdd->query('SELECT id,titre,contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y %Hh%imin%ss\') AS date_cr FROM billets ORDER BY date_creation DESC LIMIT 0,5');

										//on affiche chaque entrée une à une
										while ($donnees = $reponse->fetch()) {
										echo '<div class="news">';
										echo '<h3>'. htmlspecialchars($donnees['titre']) .' '.$donnees['date_cr'].'</h3>';
										echo '<p>'. nl2br(htmlspecialchars($donnees['contenu'])) .'<br/><br /><a href="commentaires.php?commentairesid='.$donnees['id'].'">commentaires</a></p>';
										echo '</div>';
										}

										$reponse->closeCursor();
										?>

										</body>
										</html>
