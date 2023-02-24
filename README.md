# Initial docker with Nginx, PHP and MySql


## Set up 

```
docker compose up -d
visit http://localhost:5006
```

## Other commands

```
docker compose up -d --build

docker compose exec php sh
docker compose exec nginx sh
docker compose exec mysql sh

mysql -u root -p"root" -h localhost 
```

## Create DB

```
docker compose exec mysql sh
create database test;
```

## Connect to DB

```
docker compose exec mysql sh
mysql -u root -p"root" -h localhost 
```
