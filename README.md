# Backoffice d'un site de produits divers et variés

Une fois connecté, un utilisateur peut mettre à jour les produits, catégories, types, marques et tags affichés sur son site.
Il a également la possibilité de modifier l'ordre d'affichage des catégories sur la page home du site, un visuel de la page l'aidera à confirmer son choix lors de ses modifications dans le backoffice. 

Le backoffice a été réalisé à l'aide du Framework Laravel.
Il suit les designs Patterns MVC et Active record.

Il comprend :

- Un CRUD complet pour les produits, catégories, types, marques, tags
- Une gestion des tokens CSRF
- Un middleware pour nettoyer de toutes balises les données des inputs :
  https://github.com/Damien-LAITANI/backoffice_MVC/blob/8f801e5d3587e7b1763fe7478c928c34fbb74080/backoffice/app/Http/Middleware/TransformsRequest.php