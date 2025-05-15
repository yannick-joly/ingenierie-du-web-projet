# Installation du projet

Vous noterez que certaines commandes sont préfixées par `docker compose exec php` : cela indique explicitement qu'elles doivent être exécutées à l'intérieur du conteneur servant à l'exécution du code PHP.

## Initialiser le backend

Toute cette partie doit être réalisé par **un seul membre de l'équipe** dans l'équipe. Après qu'il/elle ait poussé ces modifications sur le dépôt, les autres peuvent _Charger les dépendances_ (voir plus bas).

### Framework et squelette d'application
Commencez par créer un projet et installer ses dépendances (en gros : le framework + un exemple d'utilisation) :

```bash
docker compose exec php composer create-project yosko/watamelo-skeleton backend \
  --repository='{"type": "vcs", "url": "git@github.com:yosko/watamelo-skeleton"}'
```

_NB : vous pouvez remplacer "backend" par le nom de projet back de votre choix, en **snake-case**. Cela changera le nom de sous-dossier, mais aussi dans le code le **namespace** de base._

Équivalent en Windows Batch (aka `cmd`) / Git Bash :
```bash
docker compose exec php composer create-project yosko/watamelo-skeleton backend ^
  --repository="{\"type\":\"vcs\",\"url\":\"git@github.com:yosko/watamelo-skeleton.git\"}" ^
```

_Powershell : la syntaxe devrait être encore différente._


### Code utile
Du code nécessaire au *backend* vous est fourni dans le dossier `fragments/` : déplacez-les vers `backend/` en conservant la même sous-arborescence.

## Charger les dépendances

Si un autre membre de l'équipe a déjà intégré le squelette d'application et le framework, votre `git clone` contiendra déjà presque tout ce qu'il vous faut, excepté les dépendances (le dossier `backend/vendor/`).

Pour les récupérer, placez-vous dans `backend/`, puis tapez :

```bash
docker compose exec php composer install
```