<?php $title = '✍'?>
<?php include('header.php') ?>
<!-- Etape 1: se connecter à la base de donnée -->
<?php include('logbdd.php')?>

        <div id="wrapper" class='admin'>
            <aside>
                <h2>Mots-clés</h2>
                <?php
                /*
                 * Etape 2 : trouver tous les mots clés
                 */
                $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
                // requete et controle avant récupération
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                /*
                 * Etape 3 : @todo : Afficher les mots clés en s'inspirant de ce qui a été fait dans news.php
                 * Attention à en pas oublier de modifier tag_id=321 avec l'id du mot dans le lien
                 */
                // Récupération des données 
                while ($tag = $lesInformations->fetch_assoc())
                {
                    echo "<pre>" . print_r($tag, 1) . "</pre>";
                    ?>
                    <article>
                        <h3>#chaussette</h3>
                        <p>id:321</p>
                        <nav>
                            <a href="tags.php?tag_id=321">Messages</a>
                        </nav>
                    </article>
                <?php } ?>
            </aside>
            <main>
                <h2>Utilisatrices</h2>
                <?php
                /*
                 * Etape 4 : trouver tous les mots clés
                 * PS: on note que la connexion $mysqli à la base a été faite, pas besoin de la refaire.
                 */
                $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                /*
                 * Etape 5 : @todo : Afficher les utilisatrices en s'inspirant de ce qui a été fait dans news.php
                 * Attention à en pas oublier de modifier dans le lien les "user_id=123" avec l'id de l'utilisatrice
                 */
                // fetch_assoc donne un tableau de type clé valeur
                // La condition dans while , on affecte les informations dispos à tag . Tant qu'il y a des informations (vraie), on continue . 
                while ($tag = $lesInformations->fetch_assoc())
                {
                    //  <pre> : élément de texte préformaté / respecte le format initial
                    //  print_r : affiche les données d'une variable et la formate
                    echo "<pre>" . print_r($tag, 1) . "</pre>";
                    ?>
                    <article>
                        <h3>Alexandra</h3>
                        <p>id:123</p>
                        <nav>
                            <a href="wall.php?user_id=123">Mur</a>
                            <a href="feed.php?user_id=123">Flux</a>
                            <a href="settings.php?user_id=123">Paramètres</a>
                            <a href="followers.php?user_id=123">Suiveurs</a>
                            <a href="subscriptions.php?user_id=123">Abonnements</a>
                        </nav>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>



[red, chaise, pomme]
{
    color:red,
    furniture: chaise,
    fruit: pomme
}