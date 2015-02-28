MyTPE permet de générer un site web statique au design simpliste, et est fait pour être utilisé le plus simplement et rapidement possible.
USER/ DOIT AVOIR LE DROIT D'ECRITURE POUR TOUT UTILISATEUR DONC LE CHMOD 707²²

Il est basé sur l'architecture MVC, et ne contient que deux pages :
* index.php : permet la connexion ou la création d'un compte
* creation.php : inclut une par une toutes les pages nécessaires à la création d'un dossier
La création d'un dossier nécessite d'être connecté à son compte.

Le dossier généré est fait pour être téléchargé sous forme d'archive zip, contenant :
* page d'accueil index.html
* page work.html qui affichera toutes les parties du dossier, elle recoit en paramètre par URL
  le nom du fichier texte à inclure selon la partie
* fichiers textes vides que l'utilisateur remplit et qui sont ensuite inclus lorsqu'une page est demandée
* fichiers de style, dans stylefiles/



Etapes de génération d'un site:

1. Saisie d'informations basiques, et du nombre de parties pour découper le site
2. Mise en mémoire de ces informations dans les variables de session
3. Saisie du nombre de parties          4. Etape 2
5. Saisie des titres                    6. Etape 2 + envoi des informations à un script Bash

7. Génération du site final à partir d'un site modèle
8. Page confirmant ou non la génération du dossier
9. Dossier généré contenant le site donc les titres ont été modifiés pour correspondre au projet de l'utilisateur


Fichiers utilisés pour ces mêmes étapes:

1. view/creation/form-1.php             2. model/master.php
3. view/creation/form-2.php             4. model/master.php
5. view/creation/form-3.php             6. model/master.php

7. generate/master.sh (script utilisant le site modèle generate/template/)
8. redirection vers view/creation/form-4.php
9. lien pour visualiser les pages générées dans le dossier user/
