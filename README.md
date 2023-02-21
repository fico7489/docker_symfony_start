# Initial docker with Nginx, PHP and MySql

```
docker compose up -d --build
docker compose exec php sh
docker compose exec nginx sh
docker compose exec mysql sh
mysql -u root -p"root" -h localhost 
```
