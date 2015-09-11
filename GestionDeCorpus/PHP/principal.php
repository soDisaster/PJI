<!-- Page principal
Regroupe les éléments de l'interface graphique
  - Dossier permettant de choisir les images à ajouter à l'interface.
  - Liste déroulante affichant les fichier SQLite présents dans le dossier "Bases".
  - Deux champs éditables : Nom de la base et nom de la table.
  - Bouton "+" permettant de créer un nouveau fichier SQLite et donc une nouvelle base de données.
  - Quatre flèches :
     * <  >  Ces flèches permettent de naviguer entre chaque élément de la base, passe d'un ID un autre.
     * <|<|  |>|> Chaque champ est associé à une checkbox. En cochant une ou plusieurs checkboxs et en utilisant
     ces flèches l'utilisateur passera à l'élément précédent (ou suivant) dont l'un des champs cochés à une valeur nulle.
  - Champs éditables permettant d'écrire le nom d'un nouveau champ.
  - Bouton "Nouveau champ" permettant de créer un nouveau champ.
  - Vue d'ensemble (en haut à droite) permettant de voir en miniature toutes les images de la base de données
  et si elles contiennent une valeur nulle ou non.
  Les miniatures sont cliquables et redirige vers l'élément correspondant de la base.

-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Gestion de corpus</title>
  <!-- Fichier CSS : base.css -->
  <link href="../CSS/base.css" rel="stylesheet" type="text/css"/>
  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
</head>

<?php
  session_start();
?>

<body>

<!-- Formulaire permettant d'ajouter les photos à la base de données.
  Ajax ne permet pas de passer des images vers un fichier PHP.
  Ce formulaire est soumi à l'aide de Ajax. 
  Vers le fichier openDir.php
-->

<form id="form" action="openDir.php" method="post" enctype="multipart/form-data">
  
  <!-- Fonctionne avec le input d'id "files" -->

  <label for="files">

    <!-- Icone svg dossier -->

    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
    width="64px" height="60.001px" viewBox="0 0 64 60.001" style="enable-background:new 0 0 64 60.001;" xml:space="preserve">

    <g id="Folder">
      <g>
        <path style="fill-rule:evenodd;clip-rule:evenodd;fill:#CCA352;" d="M60,4.001H24C24,1.792,22.209,0,20,0H4
        C1.791,0,0,1.792,0,4.001V8v6.001v2c0,2.209,1.791,4,4,4h56c2.209,0,4-1.791,4-4V8C64,5.791,62.209,4.001,60,4.001z"/>
      </g>
    </g>
    <g id="File_1_">
      <g>
        <path style="fill:#FFFFFF;" d="M56,8H8c-2.209,0-4,1.791-4,4.001v4c0,2.209,1.791,4,4,4h48c2.209,0,4-1.791,4-4v-4
        C60,9.791,58.209,8,56,8z"/>
      </g>
    </g>
    <g id="Folder_1_">
      <g>
        <path style="fill:#FFCC66;" d="M60,12.001H4c-2.209,0-4,1.791-4,4v40c0,2.209,1.791,4,4,4h56c2.209,0,4-1.791,4-4v-40
        C64,13.792,62.209,12.001,60,12.001z"/>
      </g>
    </g>
  </svg>

  </label>

<!-- 
input ne s'affichant pas permettant de passer un tableau d'images via le formulaire vers le fichier openDir.php.
-->

  <input id="files" style="display: none;" name="images[]" type="file" multiple />

<!-- 
input ne s'affichant pas permettant de passer le nom de la base de données sélectionnée 
via le formulaire vers le fichier openDir.php.
-->

  <input id="db" type="hidden" name="selectbase"/>

</form>

<!-- Conteneur contenant la vue d'ensemble-->

<div id="historique"> </div>


<!-- Tableau contenant les icônes svg des quatre flèches 
  et 
  les deux champs éditables permettant de renseigner le nom de la nouvelle base et de la table
-->

<table id="bdd">
  <tr>
    <td id="tdListeD">
      <select id="bases" name="bases">
        <?php
        include('listeDeroulante.php');
        ?>
      </select>
    </td>

    <td>
      <div class="iconmelon" id="plus"> 
        <svg>
          <g id="add" data-iconmelon="Batch:bd7d75fee0b68fe8711b24394e58c6b8">
            <path id="add"  d="M16,32C7.164,32,0,24.836,0,16S7.164,0,16,0s16,7.164,16,16S24.836,32,16,32z M16,4
            C9.374,4,4,9.374,4,16s5.374,12,12,12s12-5.374,12-12S22.626,4,16,4z M22,18h-4v4c0,1.106-0.894,2-2,2c-1.104,0-2-0.894-2-2v-4h-4
            c-1.104,0-2-0.894-2-2c0-1.104,0.896-2,2-2h4v-4c0-1.104,0.896-2,2-2c1.106,0,2,0.896,2,2v4h4c1.106,0,2,0.896,2,2
            C24,17.106,23.106,18,22,18z"></path>
          </g>
        </svg>
      </div>
    </td>

    <td>
      <input name="newBase" id ="newBase" placeholder="Nom de la nouvelle base" /> 
    </td>
    <td>
      <input name="newTable" id ="newTable" placeholder="Nom de la nouvelle table" />
    </td>
  </tr>
</table>

</div>

<!-- Tableau contenant les icônes svg des quatre flèches 
  et 
  les deux champs éditables permettant de renseigner le nom de la nouvelle base et de la table
-->

<table id="tabImages">
  <tr>

     <!--  Flèches <|<|  -->

    <td>
      <div class="iconmelon" id="idPrecedentChamps"> <svg>  <g id="rewind" data-iconmelon="Batch:b03a480798de9c1d9162572ee9eddebb">
        <path id="rewind"  d="M30.944,25.764c-0.65,0.348-1.44,0.31-2.053-0.101l-12-8C16.334,17.292,16,16.667,16,16
        c0-0.67,0.334-1.292,0.89-1.664l12-8c0.614-0.408,1.402-0.448,2.053-0.1C31.593,6.583,32,7.262,32,8v16
        C32,24.738,31.594,25.414,30.944,25.764z M14.943,25.764c-0.649,0.348-1.439,0.31-2.051-0.101l-12-8C0.334,17.292,0,16.667,0,16
        c0-0.67,0.334-1.292,0.891-1.664l12-8c0.613-0.408,1.401-0.448,2.051-0.1C15.592,6.583,16,7.262,16,8v8v8
        C16,24.738,15.594,25.414,14.943,25.764z"></path>
      </g> </svg> </div>
    </td>

     <!--  Flèches <  -->


    <td>
      <div class="iconmelon" id="idPrecedent"> 
       <svg><g id="arrow-left" data-iconmelon="Icon Set:33f568b5bbbd96e08f84a202e3245bc3"><path d="M14.677,16.011L24.723,5.964c0.37-0.369,0.37-0.97,0-1.339l-3.349-3.349
        c-0.37-0.369-0.97-0.369-1.34,0L9.321,11.99c0,0-0.001,0.001-0.002,0.001l-3.349,3.35c-0.37,0.369-0.37,0.968,0,1.34
        l14.063,14.062c0.371,0.371,0.971,0.371,1.34,0l3.349-3.348c0.37-0.369,0.37-0.969,0-1.34L14.677,16.011z"></path>
      </g>
    </svg>
  </div>
</td>
<td>

   <!-- Conteneur permettant d'afficher l'image d'un des éléments de la base de données -->

  <div id="imageLigneBDD"> </div></td>


   <!--  Flèches >  -->

  <td>
    <div class="iconmelon" id="idSuivant"> <svg>
      <g id="arrow-right" data-iconmelon="Icon Set:66038db8e90c169c2dc68347f4e2c0e9">
        <path d="M25.723,15.341L11.659,1.278c-0.371-0.371-0.971-0.371-1.34,0L6.97,4.626
        c-0.37,0.369-0.37,0.969,0,1.34l10.045,10.046L6.97,26.059c-0.37,0.369-0.37,0.97,0,1.339l3.349,3.349
        c0.37,0.369,0.97,0.369,1.34,0L22.37,20.033c0.001-0.001,0.003-0.001,0.004-0.002l3.349-3.35
        C26.093,16.312,26.093,15.713,25.723,15.341z"></path>
      </g>
    </svg>
  </div>
</td>

 <!--  Flèches |>|>  -->

<td>
  <div class="iconmelon" id="idSuivantChamps"> <svg><g id="fast-forward" data-iconmelon="Batch:307ace591cd43c1226bd34867db168f7">
    <path id="fast-forward"  d="M1.057,25.764C0.406,25.414,0,24.738,0,24V8c0-0.738,0.408-1.416,1.059-1.764
    c0.649-0.348,1.438-0.308,2.051,0.1l12,8C15.666,14.708,16,15.33,16,16c0,0.668-0.334,1.292-0.893,1.664l-12,8
    C2.496,26.074,1.706,26.112,1.057,25.764z M17.056,25.764C16.406,25.414,16,24.738,16,24v-8V8c0-0.738,0.407-1.416,1.058-1.764
    c0.65-0.348,1.438-0.308,2.053,0.1l12,8C31.666,14.708,32,15.33,32,16c0,0.668-0.334,1.292-0.892,1.664l-12,8
    C18.496,26.074,17.706,26.112,17.056,25.764z"></path>
  </g>
</svg> </div>
</td>
</tr>
</table>

 <!--  Conteneur Nouveau Champ -->

<div id="blocNC">

  <!--  Champ éditable pour entrer le nom du nouveau champ -->

  <input type="text" name="nomchamp" id ="nomchamp" placeholder="Nom du nouveau champ" /> 

  <!--  Liste déroulante permettant de sélectionner le type du nouveau champ -->

  <select id="types" name="types">
    <option value="types"> Type </option>
    <option value="types"> INTEGER </option>
    <option value="types"> BOOLEAN </option>
    <option value="types"> VARCHAR(100) </option>
    <option value="types"> REAL </option>
  </select>

   <!--  Bouton pour créer un nouveau champ  -->

  <button id="nouveauChamp"> Nouveau champ </button>

  <!--  Champ éditable pour entrer la valeur par défaut pour les images précédentes pour le nouveau champ -->

</div>

<input type="text" name="VpD" id="valeurParDefaut" placeholder="Valeur par défaut" /> 


<!--  Conteneur permettant d'afficher le nom des champs,
  la zone de texte éditable pour entrer leur valeur et la checkbox
-->

<table id="aff"> </table>


<!-- jQuery et Ajax
Au clic sur un élément lance le fichier PHP réalisant l'action souhaitée 
-->

<script>

var idEnCours = -1;


$(document).ready(function(){

  /*  $.ajax({
        url: FICHIER PHP LANCE,
        type: TYPE POUR PASSAGE DES VARIABLES,
        data: 'NOM DE LA VARIABLE=' + VALEUR DE LA VARIABLE,
        success : function(content){
          SI L EXECUTION DU FICHIER PHP N'A PAS RENCONTRE DE PROBLEMES
          EXECUTION DU CONTENU DE LA FONCTION success. 
          TRAITEMENT DES VARIABLES RENVOYEES PAR LE FICHIER PHP
        }
      )} 
  */

  /* Sélection d'une base de données dans la liste déroulante */

  $('#bases').change(function() {
    var selectbase = $("select[name='bases'] > option:selected").text();
    idEnCours = -1;

  /* Affiche les infos de la base de données avec le fichier infosBDD.php */
     
    $.ajax({

      url:'infosBDD.php',
      type:'post',
      data: 'selectbase=' + selectbase + '&idEnCours=' + idEnCours,
      success : function(content){

        /* Récupère les champs et leur valeur ainsi que l'ID en cours */

        tmp = content.split(",");
        $('#aff').html(tmp[0]);
        if(tmp[1] != ""){
          $('#imageLigneBDD').html(tmp[1]);
        }
        idEnCours = tmp[2];

        /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

        $('.inputBDD').blur(function() {
          var nomChamp = $(this).attr('id');
          var valeurChamp = $(this).val();
          $.ajax({

            /* Mise à jour du champ - Fichier lancé après chaque changement */
      
            url:'miseAJourChamps.php',
            type:'post',
            data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
            success : function(content){

              /* Modifie les bords de la miniature de la vue d'ensemble
                Champs avec valeurs vides -> Bords rouges */
      
              if(content == "ok"){
                $('#miniature' + idEnCours).css({
                  'border' : 'none'
                });
              }

              else{
                $('#miniature' + idEnCours).css({
                 'border': 'solid',
                 'border-color': 'red'

               });
              }
            }

          });
        });
      }
    });

/* Vue d'ensemble 
  historique.php
*/

  $.ajax({
    url:'historique.php',
    type:'post',
    data: 'selectbase=' + selectbase,
    success : function(content){
      $('#historique').html(content);


    }
  }); 

/* Vue d'ensemble - Gestion des images
  historiqueImages.php
*/ 

  $.ajax({
    url:'historiqueImages.php',
    type:'post',
    data: 'selectbase=' + selectbase,
    success : function(content){
      tmp = content.split(",");
      var i = 0;
      while(tmp[i] != ""){
        $('#miniature' + tmp[i]).css({
         'border': 'solid',
         'border-color': 'red'
       });
        i = i + 1;
      }
      $('.miniatures').click(function(){

      /* id de la miniature permettant au clic sur une miniature d'afficher l'élément de la base correspondant */
      
      var miniature = $(this).attr('id');
      var tmpnum = miniature.split("miniature");
      idEnCours = tmpnum[1];
      $.ajax({

      /* Affiche les infos de la base de données avec le fichier infosBDD.php */

        url:'infosBDD.php',
        type:'post',
        data: 'selectbase=' + selectbase + '&idEnCours=' + idEnCours,
        success : function(content){
          tmp = content.split(",");
          $('#aff').html(tmp[0]);
          $('#imageLigneBDD').html(tmp[1]);
          idEnCours = tmp[2];

          /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

          $('.inputBDD').blur(function() {
            var nomChamp = $(this).attr('id');
            var valeurChamp = $(this).val();
            $.ajax({

               /* Mise à jour du champ - Fichier lancé après chaque changement */

              url:'miseAJourChamps.php',
              type:'post',
              data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
              success : function(content){

                /* Modifie les bords de la miniature de la vue d'ensemble
                Champs avec valeurs vides -> Bords rouges  */

                if(content == "ok"){
                  $('#miniature' + idEnCours).css({
                    'border' : 'none'
                  });
                }

                else{
                  $('#miniature' + idEnCours).css({
                   'border': 'solid',
                   'border-color': 'red'

                 });
                }
              }

            });
          });
        }
      });
});
 /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

$('.inputBDD').blur(function() {
  var nomChamp = $(this).attr('id');
  var valeurChamp = $(this).val();
  $.ajax({

     /* Mise à jour du champ - Fichier lancé après chaque changement */

    url:'miseAJourChamps.php',
    type:'post',
    data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
    success : function(content){

      /* Modifie les bords de la miniature de la vue d'ensemble
         Champs avec valeurs vides -> Bords rouges */

      if(content == "ok"){
        $('#miniature' + idEnCours).css({
          'border' : 'none'
        }); 
      }
      else{
        $('#miniature' + idEnCours).css({
         'border': 'solid',
         'border-color': 'red'

       });
      }
    }  
  });
});


}
});
});


 /* Au clic sur le bouton "+", création de la base de données
    creationBDD.php
 */

$('#plus').click(function() {
  var newBDD = $('#newBase').val();
  var newTable = $('#newTable').val();
  $.ajax({
    url:'creationBDD.php',
    type:'post',
    data: 'newBDD=' + newBDD + '&newTable=' + newTable,
    dataType : 'html',
    success : function(content){     
      $.ajax({
        url:'listeDeroulante.php',
        type:'post',
        data: 'newBDD=' + newBDD,
        success : function(content){
          $('#bases').html(content);
        }
      });
    }
  });
});  

 /* Au clic sur le bouton "Nouveau champ", création d'un nouveau champ 
 nouveauChamp.php
 */


$('#nouveauChamp').click(function() {
  var BDDchoisie = $("select[name='bases'] > option:selected").text();
  var selectbase = $("select[name='bases'] > option:selected").text();

  var nomchamp = $('#nomchamp').val();
  var typechamp = $("select[name='types'] > option:selected").text();
  var valeurParDefaut = $("#valeurParDefaut").val();

  $.ajax({
    url:'nouveauChamp.php',
    type:'post',
    data: 'BDDchoisie=' + BDDchoisie + '&nomchamp=' + nomchamp + '&typechamp=' + typechamp + '&valeurParDefaut=' + valeurParDefaut + "&idEnCours=" + idEnCours,
    dataType : 'html',
    success : function(content){

       /* Modifie les bords de la miniature de la vue d'ensemble
          Champs avec valeurs vides -> Bords rouges */

      $('.miniatures').css({
       'border': 'solid',
       'border-color': 'red'
     });
      $.ajax({

        /* Affiche les infos de la base de données avec le fichier infosBDD.php */

        url:'infosBDD.php',
        type:'post',
        data: 'selectbase=' + selectbase + "&idEnCours=" + idEnCours,
        success : function(content){
          tmp = content.split(",");
          $('#aff').html(tmp[0]);
          $('#imageLigneBDD').html(tmp[1]);
          idEnCours = tmp[2];

          /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

          $('.inputBDD').blur(function() {
            var nomChamp = $(this).attr('id');
            var valeurChamp = $(this).val();
            $.ajax({

               /* Mise à jour du champ - Fichier lancé après chaque changement */

              url:'miseAJourChamps.php',
              type:'post',
              data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
              success : function(content){
                if(content == "ok"){

                /* Modifie les bords de la miniature de la vue d'ensemble
                Champs avec valeurs vides -> Bords rouges */

                  $('#miniature' + idEnCours).css({
                    'border' : 'none'
                  });
                }

                else{
                  $('#miniature' + idEnCours).css({
                   'border': 'solid',
                   'border-color': 'red'

                 });
                }
              }

            });
          });
        }

      });
}
});
});


 /* Au clic sur la flèche >, passe à l'ID suivant
 idSuivant.php
*/

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

      /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

      $('.inputBDD').blur(function() {
        var nomChamp = $(this).attr('id');
        var valeurChamp = $(this).val();
        $.ajax({

           /* Mise à jour du champ - Fichier lancé après chaque changement */

          url:'miseAJourChamps.php',
          type:'post',
          data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
          success : function(content){

           /* Modifie les bords de la miniature de la vue d'ensemble
                Champs avec valeurs vides -> Bords rouges */

           if(content == "ok"){
            $('#miniature' + idEnCours).css({
              'border' : 'none'
            });
          }

          else{
            $('#miniature' + idEnCours).css({
             'border': 'solid',
             'border-color': 'red'

           });
          }
          $.ajax({

             /* Affiche les infos de la base de données avec le fichier infosBDD.php */

            url:'infosBDD.php',
            type:'post',
            data: 'selectbase=' + selectbase + "&idEnCours=" + idEnCours,
            success : function(content){
              tmp = content.split(",");
              $('#aff').html(tmp[0]);
              $('#imageLigneBDD').html(tmp[1]);
              idEnCours = tmp[2];

              /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

              $('.inputBDD').blur(function(){
                var nomChamp = $(this).attr('id');
                var valeurChamp = $(this).val();
                $.ajax({

                   /* Mise à jour du champ - Fichier lancé après chaque changement */

                  url:'miseAJourChamps.php',
                  type:'post',
                  data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
                  success : function(content){

                  /* Modifie les bords de la miniature de la vue d'ensemble
                  Champs avec valeurs vides -> Bords rouges */

                    if(content == "ok"){
                      $('#miniature' + idEnCours).css({
                        'border' : 'none'
                      });
                    } 
                    else{
                      $('#miniature' + idEnCours).css({
                       'border': 'solid',
                       'border-color': 'red'

                     });
                    }

                  }
                });
              });
            }
          });
}
});
});
}
});   
}); 

 /* Au clic sur la flèche <, passe à l'ID précédent
 idPrecedent.php
 */

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

      /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

      $('.inputBDD').blur(function(){
        var nomChamp = $(this).attr('id');
        var valeurChamp = $(this).val();
        $.ajax({

           /* Mise à jour du champ - Fichier lancé après chaque changement */

          url:'miseAJourChamps.php',
          type:'post',
          data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
          success : function(content){

             /* Modifie les bords de la miniature de la vue d'ensemble
                Champs avec valeurs vides -> Bords rouges */

            if(content == "ok"){
              $('#miniature' + idEnCours).css({
                'border' : 'none'
              });
            }
            else{
              $('#miniature' + idEnCours).css({
               'border': 'solid',
               'border-color': 'red'
             });

            }
            $.ajax({

               /* Affiche les infos de la base de données avec le fichier infosBDD.php */

              url:'infosBDD.php',
              type:'post',
              data: 'selectbase=' + selectbase + "&idEnCours=" + idEnCours,
              success : function(content){
                tmp = content.split(",");
                $('#aff').html(tmp[0]);
                $('#imageLigneBDD').html(tmp[1]);
                idEnCours = tmp[2];

                /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

                $('.inputBDD').blur(function(){
                  var nomChamp = $(this).attr('id');
                  var valeurChamp = $(this).val();
                  $.ajax({

                     /* Mise à jour du champ - Fichier lancé après chaque changement */

                    url:'miseAJourChamps.php',
                    type:'post',
                    data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
                    success : function(content){
                      if(content == "ok"){

                         /* Modifie les bords de la miniature de la vue d'ensemble
                        Champs avec valeurs vides -> Bords rouges */

                        $('#miniature' + idEnCours).css({
                          'border' : 'none'
                        });
                      }
                      else{
                        $('#miniature' + idEnCours).css({
                         'border': 'solid',
                         'border-color': 'red'
                       });

                      }
                    }  
                  });
                });
              }
            }); 
}
});
});
}
});
}); 

 /* Soumet le formulaire permettant d'ajouter les images à la base de données */

$('#form').change(function() {
  var selectbase = $("select[name='bases'] > option:selected").text();
  $('#db').val(selectbase);
  $('#form').submit(); 
});

   




 /* Au clic sur la flèche <|<|, passe à l'ID précédent où les champs séléctionnés ont des valeurs nulles 
 idPrecedentChamps.php
 */

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

 /* Au clic sur la flèche |>|>, passe à l'ID suivant où les champs séléectionnés ont des valeurs nulles 
 idSuivantChamps.php
 */

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


/* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

$('.inputBDD').blur(function() {
  var nomChamp = $(this).attr('id');
  var valeurChamp = $(this).val();
  $.ajax({

     /* Mise à jour du champ - Fichier lancé après chaque changement */

    url:'miseAJourChamps.php',
    type:'post',
    data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
    success : function(content){
      if(content == "ok"){

         /* Modifie les bords de la miniature de la vue d'ensemble
            Champs avec valeurs vides -> Bords rouges */

        $('#miniature' + idEnCours).css({
          'border' : 'none'
        });
      }

      else{
        $('#miniature' + idEnCours).css({
         'border': 'solid',
         'border-color': 'red'

       });
      }
    }

  });
});





/* Au clic sur les miniatures de la vue d'ensemble affiche l'élément de la base de données */

$('.miniatures').click(function(){
  var miniature = $(this).attr('id');
  var tmpnum = miniature.split("miniature");
  var idEnCours = tmpnum[0];
  console.log(idEnCours);
  $.ajax({

    /* Affiche les infos de la base de données avec le fichier infosBDD.php */

    url:'infosBDD.php',
    type:'post',
    data: 'selectbase=' + selectbase + '&idEnCours=' + idEnCours,
    success : function(content){
      tmp = content.split(",");
      $('#aff').html(tmp[0]);
      $('#imageLigneBDD').html(tmp[1]);
      idEnCours = tmp[2];

      /* A chaque perte de focus sur un champ éditable, enregistrement de la valeur */

      $('.inputBDD').blur(function() {
        var nomChamp = $(this).attr('id');
        var valeurChamp = $(this).val();
        $.ajax({

           /* Mise à jour du champ - Fichier lancé après chaque changement */

          url:'miseAJourChamps.php',
          type:'post',
          data: 'selectbase=' + selectbase + '&nomChamp=' + nomChamp + '&valeurChamp=' + valeurChamp + '&idEnCours=' + idEnCours,
          success : function(content){

             /* Modifie les bords de la miniature de la vue d'ensemble
                Champs avec valeurs vides -> Bords rouges */

            if(content == "ok"){
              $('#miniature' + idEnCours).css({
                'border' : 'none'
              });
            }

            else{
              $('#miniature' + idEnCours).css({
               'border': 'solid',
               'border-color': 'red'

             });
            }
          }

        });
      });
    }
  });
});
});

</script> 




</body>
</html>