<link rel="stylesheet" href="style.css" type="text/css">
<?php 

    //fonction qui se connecte à la base de données 
    function seconnecter($nom_host, $nom_util, $mdp, $bdd, $port){
        $db = mysqli_connect($nom_host, $nom_util, $mdp, $bdd, $port) or die("Error SQL:".mysqli_error($db)); // se connecter à la base 
        $db -> query("SET NAMES UTF8");

        return $db; // On retourne un pointeur vers la base de données
    }
    // fonction qui se deconnecte de la base de données 
    function se_deconnecter($db){
        mysqli_close($db);
    }
    // fonction qui affiche les differents catégories existantes depuis un base de données 
    function afficher_categories($db){
        $sql = "SELECT * FROM categorie"; // on spécifie notre requete
        $resultat = $db->query($sql) or die("Error SQL:".mysqli_error($db)); // on execute la requete
        $i=0;
       
        // Parcourir les résultats et afficher les catégories
        while ($table = mysqli_fetch_assoc($resultat)){
            $i+=1; // je differencie entre les 5 balise (5 categorie) pour former la forme specifier dans le cahier des charges
            $html = '<div class="cat'.$i.'">';
            $html .= '<div class="'.$table['libelle'].'"><a href="'.$table['libelle'].'.php"><img src="img_categories/'.$table['image'].'"></a><br></div>';
            //$html .= '<div class="'.$table['libelle'].'"><a href="'.$table['libelle'].'.php"><img src="img_categories/'.$table['image'].'"></a><br></div>';
            $html .= '<label for="'.$table['libelle'].'">Jeux de<br>'.$table['libelle'].'</label>';
            $html .= '</div>';
            echo $html;
        }
        
    }
    // fonction qui affiche les article de categorie simulation 
    function afficher_simulation($db){
        $sql = "SELECT * FROM article WHERE id_categorie = (SELECT id FROM categorie WHERE libelle ='simulation');";
        $resultat = $db->query($sql) or die("Error SQL:".mysqli_error($db));
        $i=0;
        // Parcourir les résultats et afficher les catégories
        echo '<a href="index.php"><button class="bouton">RETOUR</button></a>'; // bouton de retour pour revenir à la page principale
        echo '<div class="scrolleur">';
        while ($table = mysqli_fetch_assoc($resultat)){
            $i+=1;
            //$html = '<form name="fo" method="post">';

            // html contient une balise d'affichage de chaque article selon le style spécifié
            $html = '<div class="jeux_conteneur">';
            $html .= '<div  class="jeux"><img src="img_articles/'.$table['image'].'"></div>';
            $html .= '<div class="jeux_infos">';
            $html .= '&nbsp;<label for="text">'.$table['libelle'].'</label><br>';
            $html .= '&nbsp;'.$table['detail'].'<br>';
            $html .= '<p></p><br>';
            $html .= '&nbsp;<label for="text">'.$table['prix_ttc'].'€</label><br>';
            $html .= '<form method="post"><input type="submit" name="commander'.$i.'" class ="bouton" value="COMMANDER"/>';
            $html .='</div></div>';

            echo $html;

            if(isset($_POST['commander'.$i])) {
                    
                if (!creationPanier()) { // si le panier n'est pas créé
                    // creation du panier 
                    creationPanier();
                }   
                // ajout de l'article lorsqu'on clique sur le bouton commander
                ajouterArticle($table['libelle'],$table['prix_ttc']);
            }       
            if($i%3 ==0){
                echo '<br>&nbsp&nbsp'; // Je veux que les articles s'affiche en plusieurs lignes mais en deux colonnes ! 
            }
        }
        echo '</div>';
        
    }
    // fonction qui affiche les article de categorie aventure 
    function afficher_aventure($db){
        $sql = "SELECT * FROM article WHERE id_categorie = (SELECT id FROM categorie WHERE libelle ='aventure');";
        $resultat = $db->query($sql) or die("Error SQL:".mysqli_error($db));
        $i=0;
        // Parcourir les résultats et afficher les catégories
        echo '<a href="index.php"><button class="bouton">RETOUR</button></a>'; // bouton de retour pour revenir à la page principale

        echo '<div class="scrolleur">';
        while ($table = mysqli_fetch_assoc($resultat)){
            $i+=1;
            //$html = '<form name="fo" method="post">';

            // html contient une balise d'affichage de chaque article selon le style spécifié
            $html = '<div class="jeux_conteneur">';
            $html .= '<div  class="jeux"><img src="img_articles/'.$table['image'].'"></div>';
            $html .= '<div class="jeux_infos">';
            $html .= '&nbsp;<label for="text">'.$table['libelle'].'</label><br>';
            $html .= '&nbsp;'.$table['detail'].'<br>';
            $html .= '<p></p><br>';
            $html .= '&nbsp;<label for="text">'.$table['prix_ttc'].'€</label><br>';
            $html .= '<form method="post"><input type="submit" name="commander'.$i.'" class ="bouton" value="COMMANDER"/>';
            $html .='</div></div>';

            echo $html;

            if(isset($_POST['commander'.$i])) {
                    
                if (!creationPanier()) { // si le panier n'est pas créé
                    // creation du panier 
                    creationPanier();
                }   
                // ajout de l'article lorsqu'on clique sur le bouton commander
                ajouterArticle($table['libelle'],$table['prix_ttc']);
            }       
            if($i%3 ==0){
                echo '<br>&nbsp&nbsp'; // Je veux que les articles s'affiche en plusieurs lignes mais en deux colonnes ! 
            }
        }
        echo '</div>';
        
    }
    // fonction qui affiche les article de categorie sport 
    function afficher_sport($db){
        $sql = "SELECT * FROM article WHERE id_categorie = (SELECT id FROM categorie WHERE libelle ='sport');";
        $resultat = $db->query($sql) or die("Error SQL:".mysqli_error($db));
        $i=0;
        // Parcourir les résultats et afficher les catégories
        echo '<a href="index.php"><button class="bouton">RETOUR</button></a>'; // bouton de retour pour revenir à la page principale

        echo '<div class="scrolleur">';
        while ($table = mysqli_fetch_assoc($resultat)){
            $i+=1;
            //$html = '<form name="fo" method="post">';

            // html contient une balise d'affichage de chaque article selon le style spécifié
            $html = '<div class="jeux_conteneur">';
            $html .= '<div  class="jeux"><img src="img_articles/'.$table['image'].'"></div>';
            $html .= '<div class="jeux_infos">';
            $html .= '&nbsp;<label for="text">'.$table['libelle'].'</label><br>';
            $html .= '&nbsp;'.$table['detail'].'<br>';
            $html .= '<p></p><br>';
            $html .= '&nbsp;<label for="text">'.$table['prix_ttc'].'€</label><br>';
            $html .= '<form method="post"><input type="submit" name="commander'.$i.'" class ="bouton" value="COMMANDER"/>';
            $html .='</div></div>';

            echo $html;

            if(isset($_POST['commander'.$i])) {
                    
                if (!creationPanier()) { // si le panier n'est pas créé
                    // creation du panier 
                    creationPanier();
                }   
                // ajout de l'article lorsqu'on clique sur le bouton commander
                ajouterArticle($table['libelle'],$table['prix_ttc']);
            }       
            if($i%3 ==0){
                echo '<br>&nbsp&nbsp'; // Je veux que les articles s'affiche en plusieurs lignes mais en deux colonnes ! 
            }
        }
        echo '</div>';
    }
    // fonction qui affiche les article de categorie combat
    function afficher_combat($db){
        $sql = "SELECT * FROM article WHERE id_categorie = (SELECT id FROM categorie WHERE libelle ='combat');";
        $resultat = $db->query($sql) or die("Error SQL:".mysqli_error($db));
        $i=0;
        // Parcourir les résultats et afficher les catégories
        echo '<a href="index.php"><button class="bouton">RETOUR</button></a>'; // bouton de retour pour revenir à la page principale

        echo '<div class="scrolleur">';
        while ($table = mysqli_fetch_assoc($resultat)){
            $i+=1;
            //$html = '<form name="fo" method="post">';

            // html contient une balise d'affichage de chaque article selon le style spécifié
            $html = '<div class="jeux_conteneur">';
            $html .= '<div  class="jeux"><img src="img_articles/'.$table['image'].'"></div>';
            $html .= '<div class="jeux_infos">';
            $html .= '&nbsp;<label for="text">'.$table['libelle'].'</label><br>';
            $html .= '&nbsp;'.$table['detail'].'<br>';
            $html .= '<p></p><br>';
            $html .= '&nbsp;<label for="text">'.$table['prix_ttc'].'€</label><br>';
            $html .= '<form method="post"><input type="submit" name="commander'.$i.'" class ="bouton" value="COMMANDER"/>';
            $html .='</div></div>';

            echo $html;

            if(isset($_POST['commander'.$i])) {
                    
                if (!creationPanier()) { // si le panier n'est pas créé
                    // creation du panier 
                    creationPanier();
                }   
                // ajout de l'article lorsqu'on clique sur le bouton commander
                ajouterArticle($table['libelle'],$table['prix_ttc']);
            }       
            if($i%3 ==0){
                echo '<br>&nbsp&nbsp'; // Je veux que les articles s'affiche en plusieurs lignes mais en deux colonnes ! 
            }
        }
        echo '</div>';
    }

    function afficher_horreur($db){
        $sql = "SELECT * FROM article WHERE id_categorie = (SELECT id FROM categorie WHERE libelle ='horreur');";
        $resultat = $db->query($sql) or die("Error SQL:".mysqli_error($db));
        $i=0;
        // Parcourir les résultats et afficher les catégories
        echo '<a href="index.php"><button class="bouton">RETOUR</button></a>'; // bouton de retour pour revenir à la page principale
        echo '<div class="scrolleur">';
        while ($table = mysqli_fetch_assoc($resultat)){
            $i+=1;
            //$html = '<form name="fo" method="post">';

            // html contient une balise d'affichage de chaque article selon le style spécifié
            $html = '<div class="jeux_conteneur">';
            $html .= '<div  class="jeux"><img src="img_articles/'.$table['image'].'"></div>';
            $html .= '<div class="jeux_infos">';
            $html .= '&nbsp;<label for="text">'.$table['libelle'].'</label><br>';
            $html .= '&nbsp;'.$table['detail'].'<br>';
            $html .= '<p></p><br>';
            $html .= '&nbsp;<label for="text">'.$table['prix_ttc'].'€</label><br>';
            $html .= '<form method="post"><input type="submit" name="commander'.$i.'" class ="bouton" value="COMMANDER"/>';
            $html .='</div></div>';

            echo $html;

            if(isset($_POST['commander'.$i])) {
                    
                if (!creationPanier()) { // si le panier n'est pas créé
                    // creation du panier 
                    creationPanier();
                }   
                // ajout de l'article lorsqu'on clique sur le bouton commander
                ajouterArticle($table['libelle'],$table['prix_ttc']);
            }       
            if($i%3 ==0){
                echo '<br>&nbsp&nbsp'; // Je veux que les articles s'affiche en plusieurs lignes mais en deux colonnes ! 
            }
        }
        echo '</div>';
        
    }

    function creationPanier(){
        if (!isset($_SESSION['GestionnairePanier'])){
            $_SESSION['GestionnairePanier']=array();
            $_SESSION['GestionnairePanier']['idProduit'] = array();
            $_SESSION['GestionnairePanier']['quantiteProduit'] = array();
            $_SESSION['GestionnairePanier']['prixProduit'] = array();
        }
        return true;
    }

    function ajouterArticle($libelleProduit,$prixProduit){
        
        if (creationPanier()){
            
            $positionProduit = array_search($libelleProduit,  $_SESSION['GestionnairePanier']['idProduit']);
            if ($positionProduit !== false){
                $_SESSION['GestionnairePanier']['quantiteProduit'][$positionProduit] += 1 ;
            }
            else{
                array_push( $_SESSION['GestionnairePanier']['idProduit'],$libelleProduit);
                array_push( $_SESSION['GestionnairePanier']['quantiteProduit'],1);
                array_push( $_SESSION['GestionnairePanier']['prixProduit'],$prixProduit);
            }
        }

    }

    function TotalPrix(){
		$total=0;
		for($i = 0; $i < count($_SESSION['GestionnairePanier']['idProduit']); $i++){
			$total += $_SESSION['GestionnairePanier']['quantiteProduit'][$i] * $_SESSION['GestionnairePanier']['prixProduit'][$i];
		}
		return $total;
	}
    
    // Supression du panier
	function supprimePanier(){
		unset($_SESSION['GestionnairePanier']);
	}
    
?>