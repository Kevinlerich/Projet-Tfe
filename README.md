## STAR OF SERVICES

# Lancement de l'application
Version de PHP: 8.1
Version de Laravel: 10
Xampp Server

1. Copier le projet dans un dossier
2. Ouvrir le projet sur le terminal et mettez-vous a la racine du projet puis, Installer les dependences avec les commandes: `composer install` puis `npm install`.
3. Inserer les parametres de connexion a la base de donnees et pour l'envoi de mail dans le fichier `.env` qui se trouve a la racine du projet.
Example pour la base de donnees: `DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nom_de_la_base_de_donnees
   DB_USERNAME=nom_de_utilisateur_base_de_donne
   DB_PASSWORD=mot_de_passe_base_de_donne`

Exemple pour les mails: `MAIL_MAILER=smtp
MAIL_HOST=smtp.ionos.com
MAIL_PORT=587
MAIL_USERNAME="username@example.com"
MAIL_PASSWORD="motdepasse"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="username@example.com"
MAIL_FROM_NAME="${APP_NAME}"`
4. Sur votre terminal, lancer cette commande: `php artisan storage:link` qui permet de creer un dossier symbolique dand le dossier `public`
5. Pour lancer l'application, taper `php artisan serve`
6. Panel administratif: `localhost:8000/admin`
7. Entrer les identifiants suivants: `email@example.com` et le mot de passe: `motepasse`
8. Taper la commande `php artisan schedule:work
   `  pour lancer l'ecoute des travaux de l'application au niveau de l'archivage des annonces.
