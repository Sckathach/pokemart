# Pokémart
<p align="center">
    <img src="public/images/other/readme_pokemart.gif" alt="pokemart_gif">
</p>
<p align="center">
    <b>Vente de maaaaagnifiques peluches pokémon</b>
</p>
<p align="center">
    <b>Auteurs : ChatGPT, Winninger Thomas</b>
</p>
<p align="center">
    <a target="_blank" href="https://www.pokemoncenter.com/category/plush"><img src="https://img.shields.io/badge/pokémon-plushies-FF0000"/></a>
    <a target="_blank" href="https://github.com/Sckathach/pokemart"><img src="https://img.shields.io/badge/github-Sckathach-black"/></a>
</p>

## Installation
- Télécharger le projet sur Moodle ou sur ma [page GitHub](https://github.com/Sckathach/pokemart).
- `rm -fr composer.lock symfony.lock vendor/ var/cache/` : Pour supprimer le cache.
- `symfony composer install` : Installer toutes les dépendances.
> Si la console demande : ``` 
Do you want to include Docker configuration from recipes?
    [y] Yes
    [n] No
    [p] Yes permanently, never ask again for this project
    [x] No permanently, never ask again for this project
    (defaults to y):
``` appuyez sur `entrer` ou `y`.
- `symfony server:start` : Lancer le serveur.

## Fonctionnalités 
- Consultation des peluches à partir du bouton `Découvrir` depuis la page d'accueil, ou avec `plush/list`.
- Consutlation des peluches \[OBJET\] appartenant à une génération \[INVENTAIRE\] en naviguant avec les boutons `Tout`, 
`Génération 1`, `Génération 2`, ... sur la page `plush/list`.
- Création de peluches à partir de l'espace membre disponible à `/account` ou en se connectant. 
- Modification de peluches existantes (qui nous appartiennent si on est USER, ou toutes les peluches si on est ADMIN) en 
cliquant sur `modifier` **à partir de l'espace personnel**.
- Les utilisateurs sont reliés aux membres et leurs messages sont affichés en page d'acceuil, mais il n'est pas encore 
possible de créer des commentaires depuis l'espace membre.

## Routes
- `/` : Page d'accueil gérée par `IndexController`. Le template est `index.html.twig`.
- `/plush/list` : Liste de toutes les peluches. Le template est `plush_list.html.twig`.
- `/plush/{id}` : Page d'achat de la peluche selectionnée, les identifiants `{id}` commencent à 1. Le template est
`plush_show.html.twig`.
- `/plush/{id}/edit` : Page pour éditer les peluches. Page seulement accessible aux USER/ ADMIN.
- `/plush/new` : Création d'une nouvelle peluche. Page seulement accessible aux USER/ ADMIN.
- `/login` : Page d'authentification.
- `/logout` : Page de dé-authentification.
- `/account` : Page personnelle.
- Toutes les pages étendent la base `base.html.twig`.
- `/admin` : La page existe, mais je ne l'ai pas du tout configurée. 

## Roles
- Non authentifié : à accès à la liste, mais ne peut ni créer, ni modifier une peluche.
- USER : Les membres peuvent créer des peluches et **modifier leurs peluches**.
- ADMIN : Les administrateurs peuvent créer des peluches et **modifier toutes les peluches**.

## Membres
| id | name          | email                 | password | role  |
|----|---------------|-----------------------|----------|-------|
| 1  | Professor Oak | professor@pokemon.org | password | ADMIN |
| 2  | Cynthia       | cynthia@pokemon.org   | password | ADMIN |
| 3  | Red           | red@pokemon.org       | password | USER  |

Pour tester les fonctionnalités en temps que membre ou administrateur, vous pouvez aller sur la page `/login` en 
appuyant sur le bouton `Se connecter` dans la barre de navigation.

## Entités
Il n'y a pas de `TODO.txt`, je pense que les informations présentes dans ce `README.md` sont suffisantes. Je gère 
généralement mes tâches avec les *Issues*.
### Peluches (Plushies)
L'objet de base est la peluche. Chaque peluche appartient à une génération (inventaire). Chaque génération comporte
plusieurs peluches. Une peluche ne peut appartenir à plusieurs génération (je prends la prémière génération où le
pokémon apparaît).

| id | name     | price | height | generation  | 
|----|----------|-------|--------|-------------|
| 1  | Jirachi  | 10.99 | 6.5    | Generation2 |
| 2  | Évoli    | 16.99 | 6.5    | Generation2 |
| 3  | Dracofeu | 16.99 | 7      | Generation2 |
| 4  | Noctali  | 19.99 | 13     | Generation2 |

### Générations (Generations)
C'est l'object qui correspond au role de l'inventaire. Chaque peluche appartient à une collection. Il est possible dans 
la page `/plush/list` de choisir la génération pour filtrer les peluches. 

| id | name        | tag  | description |
|----|-------------|------|-------------|
| 1  | Generation1 | gen1 | ...         | 
| 2  | Generation2 | gen2 | ...         |
| 3  | Generation3 | gen3 | ...         |
| 4  | Generation4 | gen4 | ...         | 

## Copyrights
[Pokémon](https://www.pokemoncenter.com/category/plush)

[Free CSS templates](https://www.free-css.com/)

> Oui, je n'ai pas écrit les 7438957839 lignes de code CSS tout seul -_-
