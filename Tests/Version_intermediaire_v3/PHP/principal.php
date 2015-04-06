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
        <label id="dossier">
            <img src="../ImagesInterface/dossier.jpg" width="125" height="100"/>
        </label>
        <input style="display: none;"/>

       
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
        <option value="types"> VARCHAR(100) </option>
        <option value="types"> REAL </option>
    </select>

    <button id="idPrecedent"> idPrecedent </button>
    <button id="idSuivant"> idSuivant </button>
    
    <script>

      var idEnCours = 0;
      
      $(document).ready(function(){


          $('select[name="bases"]').change(function() {
              var selectbase = $("select[name='bases'] > option:selected").text();
                  $.ajax({
                    url:'infosBDD.php',
                    type:'post',
                    data: 'selectbase=' + selectbase,
                    dataType : 'html',
                    success : function(content){
                      tmp = content.split(",");
                      $('#aff').html(tmp[0]);
                      idEnCours = tmp[1];
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
                    }
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


          $('#idSuivant').click(function() {
            var selectbase = $("select[name='bases'] > option:selected").text();
             $.ajax({
                  url:'idSuivant.php',
                  type:'post',
                  data: 'selectbase=' + selectbase + "&idEnCours=" + idEnCours,
                  success : function(content){
                      tmp = content.split(",");
                      $('#aff').html(tmp[0]);
                      idEnCours = tmp[1];
                  }
              });   
            
           });

           $('#idPrecedent').click(function() {
            var selectbase = $("select[name='bases'] > option:selected").text();
             $.ajax({
                  url:'idPrecedent.php',
                  type:'post',
                  data: 'selectbase=' + selectbase + "&idEnCours=" + idEnCours,
                  success : function(content){
                      tmp = content.split(",");
                      $('#aff').html(tmp[0]);
                      idEnCours = tmp[1];
                  }
              });   
            
           });  

           $('#dossier').click(function() {
            var selectbase = $("select[name='bases'] > option:selected").text();
             $.ajax({
                  url:'openDir.php',
                  type:'post',
                  data: 'selectbase=' + selectbase,
                  success : function(content){
                      console.log(content);
                  }
              });   
            
           });     

      });

    </script> 

    <table id="aff"> </table>
    <p id="test"> </p>
    

  </body>
</html>