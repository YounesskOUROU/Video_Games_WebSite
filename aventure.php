<?php
    session_start();
    include('fonctions_contenu.php');
?>
<html>
    <head>
        <title>Jeux Videos</video></title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
        <div class="page">
            <!-- le bloc qui contient le titre  -->
            <div class="titre">
                <div class="titre_logo"><img src="img_site/icone-site.gif"></div>
                <h1 class="titre-1">JEUX VIDEOS</h1>
            </div>
            <!-- le bloc qui contient l'authentification -->
            <div class="authentification">
                <div class="login">
                    <label for="adresse_mail">adresse mail</label><br>
                    <input type="text" name="mail" id="mail"><br>
                    <label for="mdp">mot de passe</label> <br>
                    <input type="password" name="mdp" id="mdp"><br>
                </div>
                <div class="boutons">
                    <button class="bouton">S'INSCRIRE</button>
                    <button class="bouton">CONNEXION</button>
                </div> 
            </div>
            <!-- le bloc qui contient le contenu dynamique du site; peut contenir  {categorie, liste des articles de chaque catégorie} -->
            <div class="contenu">
                <?php
                    
                    $db = seconnecter("localhost", "jeux-videos", "IsImA_2021/%", "jeux-videos", 3307);
                    afficher_aventure($db);
                    
                ?>
            </div>
            
            <!-- le bloc qui contient le panier dynamique -->
            <div class="panier">
                <div class="panier_conteneur">   
                    <img src="img_site/caddie.gif">
                    <div class="panier_texte">votre panier</div>
                    <hr>
                    <?php
                        if (creationPanier())  // si le panier existe
                        {
                            $nbArticles=count($_SESSION['GestionnairePanier']['idProduit']); 

                            for ($i=0 ;$i < $nbArticles ; $i++){
                                echo $_SESSION['GestionnairePanier']['idProduit'][$i];   
                                echo $_SESSION['GestionnairePanier']['quantiteProduit'][$i].'x';
                                echo $_SESSION['GestionnairePanier']['prixProduit'][$i].' €';     
                                echo '</br>' ;
                            }
                            echo '<hr>';
                            echo '<div id="total" >';
                            echo 'TOTAL: '.TotalPrix().' €'; 
                            echo '</div>';
                            echo '<center>';
                            echo '<form method=\"post\"><input type="submit" name="vider_panier" class="bouton" value="vider panier" />';
                            if(array_key_exists('vider_panier', $_POST)) {
                                supprimePanier() ;  
                            }
                            echo '</center>' ;
                        }   
                    ?>
                </div>
            </div>

        </div>
        
        
    </body>
</html>