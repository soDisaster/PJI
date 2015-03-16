<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Gestion de corpus</title>
    <link rel="stylesheet" href="base.css" />
    <script type="text/javascript" src="principal.js"> </script>

  </head>

  <body>

    <header>

        <!-- Dossier -->
        <label for="file">
            <img src="Images/dossier.jpg" width="125" height="100"/>
        </label>
        <input id="file" type="file" style="display: none;" onclick="test()"/>

       
    </header>

   
    <!-- Liste déroulante bases de données et bouton d'ajout -->
     <?php
            include('fonctions.php'); 
            listeD();
    ?>


    <!-- div contenant les miniatures -->

    <div id="min"></div>
    <p> Là </p>



    <button id="test"> Ici </button>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
          $('select[name="bases"]').change(function() { // lorsqu'on change de valeur dans la liste
              $("#aff").load('infos.php'); 
          });
      });

    </script> 

    <p id="aff"> </p>

  </body>
</html>