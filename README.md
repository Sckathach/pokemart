# Pokémart
- Auteurs : Winninger Thomas, ChatGPT
- Thème : Vente de peluches pokémon

## Routes
- `/` : page d'accueil gérée par `IndexController`. Le template est `index.html.twig`.
- `/plush/list` : liste de toutes les peluches. Le template est `plush_list.html.twig`.
- `/plush/{id}` : page d'achat de la peluche selectionnée, les identifiants `{id}` commencent à 1. Le template est
`plush_show.html.twig`.
- Toutes les pages étendent la base `base.html.twig`.

## Entités
### Peluches (Plushies)
| id | name     | price | height | generation | note |
|----|----------|-------|--------|------------|------|
| 1  | Jirachi  | 10.99 | 6.5    | gen3       | 5    |
| 2  | Évoli    | 16.99 | 6.5    | gen2       | 5    |
| 3  | Dracofeu | 16.99 | 7      | gen2       | 5    |
| 4  | Noctali  | 19.99 | 13     | gen2       | 5    |

### À faire
#### Générations (Generations)
| id | name        | tag  | description |
|----|-------------|------|-------------|
| 1  | Generation1 | gen1 | ...         | 
| 2  | Generation2 | gen2 | ...         |
| 3  | Generation3 | gen3 | ...         |
| 4  | Generation4 | gen4 | ...         | 

#### Cartes (Cards)
| id | name      | type     | hp |
|----|-----------|----------|----| 
| 1  | Pikachu   | electric | 90 |
| 2  | Pichu     | electric | 50 |
| 3  | Bulbasaur | grass    | 70 |

#### Collections 
| id | name | description                 | 
|----|------|-----------------------------|
| 1  | Cah  | La collection des champions |
| 2  | Tah  | La collection des trainers  |

## Copyrights
[Free CSS templates](https://www.free-css.com/)

> Oui, je n'ai pas écrit les 7438957839 lignes de code CSS tout seul -_-