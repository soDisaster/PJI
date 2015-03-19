<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Gestion de corpus</title>
    <link rel="stylesheet" href="../base.css" />
    <script type="text/javascript" src="../miniatures.js"> </script> 
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>

  </head>

  <body>

    <header>

        <!-- Dossier -->
        <label for="file">
            <img src="../Images/dossier.jpg" width="125" height="100"/>
        </label>
        <input id="file" type="file" style="display: none;" onclick="test()"/>

       
    </header>

   
    <!-- Liste déroulante bases de données et bouton d'ajout -->
     <?php
            include('listeDeroulante.php'); 
            listeD();
    ?>

    <button id="plus"> + </button>
    <input type="text" name="newBase" id ="newBase"/> 
    <input type="text" name="newTable" id ="newTable"/> 

    <!-- div contenant les miniatures -->

    <div id="min"></div>

    <button id="nouveauChamp"> Nouveau champ </button>
    <input type="text" name="nomchamp" id ="nomchamp"/> 
    <select id="types" name="types">
        <option value="types"> Types </option>
        <option value="types"> INTEGER </option>
        <option value="types"> boolean </option>
    </select>



    
    <script>
      
      $(document).ready(function(){

          $('select[name="bases"]').change(function() {
              var selectbase = $("select[name='bases'] > option:selected").text();
                  $.ajax({
                    url:'infosBDD.php',
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

            $('#plus').click(function() {
              var newBDD = $('#newBase').val();
              var newTable = $('#newTable').val();
             $.ajax({
                  url:'creationBDD.php',
                    type:'post',
                    data: 'newBDD=' + newBDD + '&newTable=' + newTable,
                    dataType : 'html'
                   
                    
              });   
              $.ajax({
                  url:'miseAJourListeD.php',
                    type:'post',
                    data: 'newBDD=' + newBDD,
                    dataType : 'html',
                    success : function(content){
                      $('#bases').append(content);
                    },
              });
           });  

           $('#nouveauChamp').click(function() {
            var BDDchoisie = $("select[name='bases'] > option:selected").text();
            var nomchamp = $('#nomchamp').val();
            var typechamp = $("select[name='types'] > option:selected").text();

             $.ajax({
                    url:'nouveauChamp.php',
                    type:'post',
                    data: 'BDDchoisie=' + BDDchoisie + '&nomchamp=' + nomchamp + '&typechamp=' + typechamp,
                    dataType : 'html'
    
              }); 
          });   


      });

    </script> 

    <p id="aff"> </p>

  </body>
</html>