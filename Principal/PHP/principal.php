  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8" />
    <title>Gestion de corpus</title>
    <link rel="stylesheet" type="text/css" href="../base.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../base.css" />


  </head>

  <body>



    <form id="form" action="openDir.php" method="post" enctype="multipart/form-data">
      <label for="files">
        <img src="../ImagesInterface/dossier.jpg" width="125" height="100"/>
      </label>
      <input id="files" style="display: none;" name="images[]" type="file" multiple />
      <input id="db" type="hidden" name="selectbase"/>
    </form>

    <!-- Jolie liste déroulante -->
    <div>
      <!-- Liste déroulante bases de données et bouton d'ajout -->
      <?php
      include('listeDeroulante.php'); 
      listeD();
      ?>
    </div>




    <button id="plus"> + </button>
    <input type="text" name="newBase" id ="newBase"/> 
    <input type="text" name="newTable" id ="newTable"/> 



    <button id="nouveauChamp"> Nouveau champ </button>
    <input type="text" name="nomchamp" id ="nomchamp"/> 
    <select id="types" name="types">
      <option value="types"> Types </option>
      <option value="types"> INTEGER </option>
      <option value="types"> boolean </option>
      <option value="types"> VARCHAR(100) </option>
      <option value="types"> REAL </option>
    </select>


    <p>
      <button id="idPrecedentChamps"> </button>
      <div id="idPrecedent"> <img  src="../ImagesInterface/gauche.png" width="25" height="25"> </div>
      <div id="imageLigneBDD"> </div>
      
      <div id="idSuivant"> <img src="../ImagesInterface/droite.png" width="25" height="25"> </div>
      <button id="idSuivantChamps"> </button>

    </p>

    <div id="champs"> </div>
    <div id="aff">  </div>


    <div id="historique"> </div>



    <script>

    var idEnCours = -1;


    $(document).ready(function(){


      $('select[name="bases"]').change(function() {
        var selectbase = $("select[name='bases'] > option:selected").text();
        $.ajax({
          url:'infosBDD.php',
          type:'post',
          data: 'selectbase=' + selectbase + '&idEnCours=' + idEnCours,
          success : function(content){
            tmp = content.split(",");
            $('#aff').html(tmp[0]);
            $('#imageLigneBDD').html(tmp[1]);
            idEnCours = tmp[2];
            $('input').blur(function() {
              var nomChamp = $(this).attr('id');
              var valeurChamp = $(this).val();
              $.ajax({
                url:'miseAJourChamps.php',
                type:'post',
                data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
                success : function(content){
                  $('#aff').html(tmp[0]);
                  $('#imageLigneBDD').html(tmp[1]);
                  idEnCours = tmp[2];
                  if(content == "ok"){
                    $('#miniature' + idEnCours).css({
                      'border' : 'none'
                    });
                  }
                }  
              });
            })
          }
        });
        $.ajax({
          url:'historique.php',
          type:'post',
          data: 'selectbase=' + selectbase,
          success : function(content){
            $('#historique').html(content); 
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
    var selectbase = $("select[name='bases'] > option:selected").text();
    
    var nomchamp = $('#nomchamp').val();
    var typechamp = $("select[name='types'] > option:selected").text();

    $.ajax({
      url:'nouveauChamp.php',
      type:'post',
      data: 'BDDchoisie=' + BDDchoisie + '&nomchamp=' + nomchamp + '&typechamp=' + typechamp,
      dataType : 'html',
      success : function(content){
        $('#aff').append(content);
        $('.miniatures').css({
         'border': 'solid',
         'border-color': 'red'
       });
        $.ajax({
          url:'infosBDD.php',
          type:'post',
          data: 'selectbase=' + selectbase + "&idEncours=" + idEnCours,
          success : function(content){
            tmp = content.split(",");
            $('#aff').html(tmp[0]);
            idEnCours = tmp[1];
            $('input').blur(function() {
              var nomChamp = $(this).attr('id');
              var valeurChamp = $(this).val();
              $.ajax({
                url:'miseAJourChamps.php',
                type:'post',
                data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
                success : function(content){
                  if(content == "ok"){
                    $('#miniature' + idEnCours).css({
                      'border' : 'none'
                    });
                  }
                }  
              });
            })
          }
        });
      } 
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
        $('#imageLigneBDD').html(tmp[1]);
        idEnCours = tmp[2];
        $('input').blur(function() {
          var nomChamp = $(this).attr('id');
          var valeurChamp = $(this).val();
          $.ajax({
            url:'miseAJourChamps.php',
            type:'post',
            data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
            success : function(content){
              if(content == "ok"){
                $('#miniature' + idEnCours).css({
                  'border-style' : 'none'
                });
              }
            }
          });
        });
      }
    });   
  });


  $('#idPrecedent').click(function(){
    var selectbase = $("select[name='bases'] > option:selected").text();
    $.ajax({
      url:'idPrecedent.php',
      type:'post',
      data: 'selectbase=' + selectbase + "&idEnCours=" + idEnCours,
      success : function(content){
        tmp = content.split(",");
        $('#aff').html(tmp[0]);
        $('#imageLigneBDD').html(tmp[1]);
        idEnCours = tmp[2];
        $('input').blur(function(){
          var nomChamp = $(this).attr('id');
          var valeurChamp = $(this).val();
          $.ajax({
            url:'miseAJourChamps.php',
            type:'post',
            data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
            success : function(content){
              if(content == "ok"){
                $('#miniature' + idEnCours).css({
                  'border' : 'none'
                });
              }
            }
          }); 
        });
      }
    });
  });

  $('#form').change(function() {
    var selectbase = $("select[name='bases'] > option:selected").text();
    $('#db').val(selectbase);
    $('#form').submit();
  });

  $('#idPrecedentChamps').click(function() {
    var selectbase = $("select[name='bases'] > option:selected").text();
    var tabCheckboxs = [];
    $("input[type='checkbox']:checked").each(function() {
      tabCheckboxs.push($(this).attr("name"));
    });
    $.ajax({
      url:'idPrecedentChamps.php',
      type:'post',
      data: 'selectbase=' + selectbase + '&tabCheckboxs=' + tabCheckboxs + '&idEnCours=' + idEnCours,
      success : function(content){
        tmp = content.split(",");
        $('#aff').html(tmp[0]);
        $('#imageLigneBDD').html(tmp[1]);
        idEnCours = tmp[2];

      }
    });   

  });



  $('#idSuivantChamps').click(function() {
    var selectbase = $("select[name='bases'] > option:selected").text();
    var tabCheckboxs = [];
    $("input[type='checkbox']:checked").each(function() {
      tabCheckboxs.push($(this).attr("name"));
    });
    $.ajax({
      url:'idSuivantChamps.php',
      type:'post',
      data: 'selectbase=' + selectbase + '&tabCheckboxs=' + tabCheckboxs + '&idEnCours=' + idEnCours,
      success : function(content){
        tmp = content.split(",");
        $('#aff').html(tmp[0]);
        $('#imageLigneBDD').html(tmp[1]);
        idEnCours = tmp[2];
      }
    });   
  });
});

  </script> 




</body>
</html>