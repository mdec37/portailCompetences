# ECF SYMFONY

## Prérequis
- PHP >= 7.2
- NPM

## Installation
1. Clôner le dépôts
2. Faire un `composer install` dans le répertoire du projet
3. Créer un fichier `.env.local` et y ajouter la configuration d'accès à la BDD
4. Créer la base de données `symfony console doctrine:database:create`
5. Effetuer les migration de la base de données `symfony console doctrine:migrations:migrate`
6. Faire un `npm install`
7. Executer un `npm run build` (lors de la première installation, puis `npm run dev-server` par la suite)
8. Démarrer le serveur `symfony serve`
9. L'application est prête
