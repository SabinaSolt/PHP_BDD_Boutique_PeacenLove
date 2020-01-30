<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
        <title> Boutique de Sabina </title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
     </head>
     <body>


        <?php

        $formNomArticleOk=false;
        $formPrixArticleOk=false;
        $formImageArticleOk=false;
        $_SESSION['nomArticle']="";
        $_SESSION['prixArticle']=0;
        $_SESSION['imageAdresse']="";
        $nomErreur=$prixErreur=$imageErreur="";

        if ($_SERVER["REQUEST_METHOD"] == "POST") //Vérifie que le formulaire a été posté
        {
            if (isset($_POST['nomArticle']))
            {
                $formNomArticleOk=true;
                $_SESSION['nomArticle']=htmlspecialchars($_POST['nomArticle']);
            }
            else
            {

                $nomErreur="le nom de l'article est obligatoire";
            }
            if (isset($_POST['prixArticle']) or is_int($_POST['prixArticle']))
            {


                $formPrixArticleOk=true;
                $_SESSION['prixArticle']=$_POST['prixArticle'];

            }
            else
            {
                $prixErreur="le prix de l'article est obligatoire et doit être un entier";
            }

            if(isset($_FILES['imageArticle']) AND ($_FILES['imageArticle']['error']==0) AND
                $_FILES['imageArticle']['size'] <=1000000)
            {
                $infoFichier =pathinfo($_FILES['imageArticle']['name']);
                $extension_upload =$infoFichier['extension'];
                $extensions_autorisees =array('jpg','jpeg','gif','png');
                if (in_array($extension_upload,$extensions_autorisees))
                {
                    move_uploaded_file($_FILES['imageArticle']['tmp_name'],'images/'.
                        basename($_FILES['imageArticle']['name']));
                    $formImageArticleOk=true;
                    $_SESSION['imageAdresse']='images/'.$_FILES['imageArticle']['name'];
                }
                else {
                    $imageErreur="L'image doit avoir l'extension .jpg  .jpeg  .gif  .png";
                }
            }
            else {
                $imageErreur=$imageErreur."L'image est obligatoire et doit être <1Mo";
            }
            if($formNomArticleOk AND $formPrixArticleOk AND $formImageArticleOk)
            {
                header("Location:http://localhost/tests_Sabina/php_etape5/displayArticle.php");
                exit;
            }
        }

        ?>
        <header class="hero" >
            <h2 class ="titre_catalogue"> Boutique de Sabina </h2>
            <p > Vous voulez en avoir plein les yeux? Votre porte-monnaie pèse trop lourd? Alors venez faire un tour dans mon e-boutique -
                le meilleur magasin en ligne du prêt-à-porter dans tout Apprieu!</p>
        </header>
    <div class="container p-3 my-3 border bg-dark text-white rounded ">
        <h2 class="form-label">Ajouter un article:</h2>
        <br>
             <form  class ="form-horizontal " action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST" enctype="multipart/form-data">
                <div class="form-group">
                     Nom Article: <br>
                    <input class="form-control" type="text" name ="nomArticle" value="<?php echo $_SESSION['nomArticle']?>" required placeholder ="Entrez le nom de l'article">
                    <span class="error text-danger"> <?php echo $nomErreur ?></span><br>
                    Prix Article: <br>
                    <input class="form-control" type="number" name ="prixArticle" value="<?php echo $_SESSION['prixArticle']?>" required placeholder ="Entrez le prix de l'article">
                    <span class="error text-danger"> <?php echo $prixErreur?></span><br>

                    Charger une image : <br>
                    <input class="form-control" type="file" name ="imageArticle"  placeholder ="Ajoutez l'image de l'article">
                    <span class="error text-danger"> <?php echo $imageErreur?></span><br>
                    <br>
                    <button class="btn btn-primary" type="submit" name="buttonSubmit"> Soumettre </button>
                </div>
             </form>
        </div>



     </body>
</html>
