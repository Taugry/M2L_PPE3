# PPE3
FREDI
Voici notre PPE FREDI de 2nd année SIO

Mathieu ARMAND / Téo AUGRY / Clément BLUZAT

[GitHub](https://github.com/MathieuARMD/PPE3.git)

La notice utilisateur est disponible [ici](https://github.com/MathieuARMD/PPE3/blob/master/notice%20utilisateur.md)
## Description
Il s'agit de la création d'un site fonctionnel et de sa base de données SQL.
 
Le site nous permet d'accéder à plusieurs onglets disponibles sur celui-ci et de se connecter en tant que membre inscrit d'une ligue de la M2L. 

Ce site doit permettre de faciliter l'établissement du document officiel permettant la remise d'impôts et remplir en ligne les frais des adhérents de clubs.


### Installation
 * Telecharger le dossier depuis github 
 * Placer le dossier dans le serveur web
 * Utiliser le script de création de base de données contenu dans le dossier /db ([PPE3-script.sql](./db/PPE3-script.sql))

### Documentation
La documentation est contenu dans le dossier [/doc](./doc)

### Finalités
* connexion/déconnexion


### Comptes

##### Adhérent : 
* ID :user  mdp :user 
* L'adhérent se sert du site pour remplir les frais du club.
* Il peut donc créer/modifier/supprimer ses lignes de frais

##### Conrtôleur :
* ID :controleur   mdp :controleur 
* Le contrôleur s'occupe de gérer les ligues et les clubs.
* Il peut donc créer/modifier/supprimer des ligues et des clubs.

##### Administrateur :
* ID :admin   mdp :adminweb2020
* L'administrateur s'occupe de gérer les frais et les périodes.
* Il peut donc créer/modifier/supprimer des périodes comptables, des motifs de frais et des utilisateurs.


! Du code appartenant a Luc Dehez a été utiliser !
ce code est en train d'être remplacé
