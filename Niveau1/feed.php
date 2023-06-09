<?php
session_start();
?>
<?php $title = '🍪'?>
<?php include('header.php') ?>

        <div id="wrapper">
            <?php
            /**
             * Cette page est TRES similaire à wall.php. 
             * Vous avez sensiblement à y faire la meme chose.
             * Il y a un seul point qui change c'est la requete sql.
             */
            /**
             * Etape 1: Le mur concerne un utilisateur en particulier
             */
            $userId = intval($_GET['user_id']);
            ?>
             <?php 
            /**
             * Etape 2: se connecter à la base de donnée
             */
            include('logbdd.php')?>

            <aside>
                <?php
                /**
                 * Etape 3: récupérer le nom de l'utilisateur
                 */
                $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                //@todo: afficher le résultat de la ligne ci dessous, remplacer XXX par l'alias et effacer la ligne ci-dessous
                echo "<pre>" . print_r($user, 1) . "</pre>";
                ?>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message des utilisatrices
                        auxquel est abonnée 
                        <?php echo $user['alias'] ?>
                    </p>

                </section>
            </aside>
            <main>
                <?php
                /**
                 * Etape 3: récupérer tous les messages des abonnements
                 */
                $laQuestionEnSql = "
                    SELECT posts.content,
                    posts.created,
                    posts.user_id as auteur_user_id,
                    users.alias as author_name,  
                    count(likes.id) as like_number,  
                    GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM followers 
                    JOIN users ON users.id=followers.followed_user_id
                    JOIN posts ON posts.user_id=users.id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE followers.following_user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                }

                /**
                 * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
                 * A vous de retrouver comment faire la boucle while de parcours...
                 */ 
                
                while ($post = $lesInformations->fetch_assoc())
                {    
                    echo "<pre>" . print_r($post, 1) . "</pre>";
                    
                    ?>     
                <article>
                <h3>
                            <time><?php echo $post['created'] ?></time>
                        </h3>
                        <address>
                            <?php
                        // <!-- echo '<a href="mon_lien.php?param='.$valeur.'">Lien</a>'; -->
                        echo '<a href="wall.php?user_id='.$post['auteur_user_id'] .'">' . $post["author_name"] . '</a>' ?>
                        </address>
                        <div>
                            <p><?php echo $post["content"] ?></p>
                        </div>
                        <footer>
                            <small>♥<?php echo $post['like_number'] ?></small>
                            <?php 
                            $tagArray = explode(",",$post['taglist']);
                                foreach ($tagArray as $tagElement){
                                    ?><a href=""><?php echo "#" . $tagElement . ", ";
                                }?>
                             </a>
                        </footer>
                </article>
            <?php 
                }
                // et de pas oublier de fermer ici vote while
                ?>


            </main>
        </div>
    </body>
</html>
