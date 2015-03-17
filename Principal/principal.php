<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Gestion de corpus</title>
    <link rel="stylesheet" href="base.css" />
    <script type="text/javascript" src="principal.js"> </script> 
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>.

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



    
    <script>
      
      jQuery(document).ready(function(){
          jQuery('select[name="bases"]').change(function() {
                  var selectbase = jQuery("select[name='bases'] > option:selected").text();
                  alert(selectbase);
                  jQuery.ajax({
                    url:'infos.php',
                    type:'post',
                    data: 'selectbase=' + selectbase,
                    dataType : 'html',
                    success : function(content){
                      console.log(content);
                      $('#aff').append(content);
                    },
                     error : function(){
                       document.write("erreur");
                    }


                });

                
          });
      });

    </script> 

    <p id="aff"> </p>

  </body>
</html>