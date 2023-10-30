# Prérequis
Php >= 8.0.1
Composer
MySQL ou Postges
Serveur Apache (Optionnel)
# Installation
Récupérer le projet et installer les dépendances
```sh
git clone https://github.com/DIMITA/ricky_and_morthy.git
cd ricky_and_morthy
composer install
```

créer la base de donnée avec le nom souhaiter et changer les information de connexion dans le fichier .env à la racine du projet
# Démarrer le projet
On a deux options
## _Utiliser Symfony en developpement uniquement (si vous l'avez déjà installer)_
Utiliser cette commande à la racine du projet pour démarrer le projet
```sh
symfony serve
```
Cette methode est utilisable qu'en local pour devlopper

## _Utiliser un serveur apache_
Le point d'entrée pour le projet est le dossier public qui se retrouve  la raçine du projet.
Donc vous ajoutez un vhost qui pointe sur le dossier public.

# Accès à la documentation d'API
Il suffit d'aller sur l'url de démarrage du projet, sur le path /api

# MCD
Voici le model conceptuel des données
![N|Solid](https://ricky-mcd.surge.sh/MCD.png)

