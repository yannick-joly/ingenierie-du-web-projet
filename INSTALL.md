# Installation du projet

## Initialiser le backend

### Framework et squelette d'application
Commencez par créer un projet et installer ses dépendances (en gros : le framework + un exemple d'utilisation) :

```bash
docker compose exec php composer create-project yosko/watamelo-skeleton backend \
  --repository='{"type": "vcs", "url": "git@github.com:yosko/watamelo-skeleton"}'
```

_NB : vous pouvez remplacer "backend" par le nom de projet back de votre choix, en **snake-case**. Cela changera le nom de sous-dossier, mais aussi dans le code le **namespace** de base._

### Code utile
Du code nécessaire au *backend* vous est fourni dans le dossier `fragments/` : déplacez-les vers `backend/` en conservant la même sous-arborescence.