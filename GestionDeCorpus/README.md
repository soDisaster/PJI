Gestion de corpus
-----------------

Ce projet consiste à réaliser l'application permettant à l'utilisateur de créer pour un sujet donné une base de données sous-jacente. L'utilisateur pourra ajouter des entrées à cette base de données et en modifier le contenu. La structure de la base de données est dynamique. Cette application permet de faciliter le travail de catégorisation de l'utilisateur tout au long de son travail sans que celui-ci n'ait à déterminer une structure définitive. La structure de la base de données n'est donc pas fixée à priori.


Langages de programmation web utilisés
--------------------------------------

- HTML5
- CSS
- JQuery
- PHP


Outils utilisés
---------------

- Serveur en local pour les appels à PHP via JQuery. 
	Utilisation de l'application MAMP sous Mac OS.
- Pour la base de données, utilisation de SQLite.
	SQLite Free pour lire les fichiers avec l'extension .sqlite sous Mac OS.


Interface graphique
-------------------

Pour le dossier ainsi que les flèches présents sur l'interface graphique, utilsiation d'icônes SVG.

  - Dossier permettant de choisir les images à ajouter à l'interface.
  - Liste déroulante affichant les fichier SQLite présents dans le dossier "Bases".
  - Deux champs éditables : Nom de la base et nom de la table.
  - Bouton "+" permettant de créer un nouveau fichier SQLite et donc une nouvelle base de données.
  - Quatre flèches :
     * <  >  Ces flèches permettent de naviguer entre chaque élément de la base, passe d'un ID un autre.
     * <|<|  |>|> Chaque champ est associé à une checkbox. En cochant une ou plusieurs checkboxs et en utilisant
     ces flèches l'utilisateur passera à l'élément précédent (ou suivant) dont l'un des champs cochés à une valeur nulle.
  - Champs éditables permettant d'écrire le nom d'un nouveau champ et une valeur par défaut optionnelle pour tous les éléments précédents.
  - Bouton "Nouveau champ" permettant de créer un nouveau champ.
  - Vue d'ensemble (en haut à droite) permettant de voir en miniature toutes les images de la base de données
  et si elles contiennent une valeur nulle ou non. Les miniatures sont cliquables et redirige vers l'élément correspondant de la base.


Bases de données SQLite
-----------------------

Ce dossier comporte 3 bases de données.
La base de données "animaux.sqlite". J'utilisais ce sujet simple pour sujet test en développement.
Les bases de données "histoire.sqlite" et "objet.sqlite" que j'ai utilisé pour présenter ma soutenance.
La base "beaucoupDeMiniatures.sqlite" qui me permet de tester l'application avec beaucoup d'images.

Exécution
---------

Pour lancer le projet, ouvrir le fichier : principal.php











