<?php
session_start();
?>
<?php $title = '😸'?>
<?php include('header.php') ?>
<?php include('logbdd.php')?>

        <div id="wrapper">
    
            <aside>
            <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
            <?php $userId = intval($_GET['user_id']) ?>
                <?php $laQuestion = "SELECT * FROM `users` WHERE id= '$userId' ";
                // requete et controle avant récupération
                $lesInfos = $mysqli->query($laQuestion);
                  $user = $lesInfos->fetch_assoc();
                  ?>

                <section>
                    <h3>Présentation</h3>
                
                    <p>Sur cette page vous trouverez la liste des personnes dont
                        l'utilisatrice <?php echo $user['alias'] ?>
                        suit les messages.
                    </p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                // Etape 1: récupérer l'id de l'utilisateur
                $userId = intval($_GET['user_id']);
                // Etape 2: se connecter à la base de donnée
                include('logbdd.php');
                // Etape 3: récupérer le nom de l'utilisateur
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                
                // Etape 4: à vous de jouer
                //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
                
                while ($follow = $lesInformations->fetch_assoc())

                {
                    echo "<pre>" . print_r($post, 1) . "</pre>";
                ?>

                <article>
                    <img src="user.jpg" alt="blason"/>
                    <h3><?php 
                    echo '<a href="wall.php?user_id='.$follow['id'] .'">' . $follow['alias'] . '</a>' ?>
                    </h3>
                    <p>id:<?php echo $follow["id"]?></p>                    
                </article>

                <?php
            }
            ?>

            </main>
        </div>
    </body>
</html>
