# vehin
Simple Vehicle Inventory with jQuery + REST API

## Install
- Install XAMP from https://www.apachefriends.org/es/index.html and Start Apache & MySQL

* Open phpMyAdmin and import vehin_db.sql from the 'extra' folder

* Open httpd.conf and set DocumentRoot and directory to
```
DocumentRoot "C:/xamp/htdocs/vehin"
<Directory "C:/xamp/htdocs/vehin">
```
* Open a web browser and navigate to
http://localhost/

* Includes Postman Collection on the 'extra' folder

## Working demo
* https://vehin.000webhostapp.com/

## API Documentation
```
- Add users to the system: (No Auth required)
http://localhost/api/create_user.php (POST)
Raw data required:
{
 "firstname" : "Admin",
 "lastname" : "User",
 "email" : "admin@myemail.com",
 "password" : "admin"
}

- Authenticate user (login) 
http://localhost/api/login.php (POST)
Raw data required:
{
 "email" : "admin@myemail.com",
 "password" : "admin"
}

- Check if Auth still alive
http://localhost/api/validate_token.php (POST)
Raw data required:
{
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NDU0NzgwMjEsImV4cCI6MTY0NTQ3ODMyMSwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdC9hcGkvIiwiZGF0YSI6eyJpZCI6IjEyIiwiZmlyc3RuYW1lIjoiVXNlciA3IiwibGFzdG5hbWUiOiJUZXN0IiwiZW1haWwiOiJ0dXNlcjdAbXllbWFpbC5jb20ifX0.ghdM7S5icsGWm9EnK3cKRxllObSaNGFYO5f_sBRJ7jE"
}

- Add a Sedan to the inventory
http://localhost/api/add_sedan.php (POST)
Raw data required:
{
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NDU0NjU0OTEsImV4cCI6MTY0NTQ2NTc5MSwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdC9hcGkvIiwiZGF0YSI6eyJpZCI6IjEyIiwiZmlyc3RuYW1lIjoiVXNlciA3IiwibGFzdG5hbWUiOiJUZXN0IiwiZW1haWwiOiJ0dXNlcjdAbXllbWFpbC5jb20ifX0.QMXDR6zMJEn0IKKceDVQAdPvNtrQ0b5yN46YnAfcrro",
    "hp": "88"
}

- Add a Bike to the inventory
http://localhost/api/add_bike.php (POST)
Raw data required:
{
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NDU0NjU0OTEsImV4cCI6MTY0NTQ2NTc5MSwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdC9hcGkvIiwiZGF0YSI6eyJpZCI6IjEyIiwiZmlyc3RuYW1lIjoiVXNlciA3IiwibGFzdG5hbWUiOiJUZXN0IiwiZW1haWwiOiJ0dXNlcjdAbXllbWFpbC5jb20ifX0.QMXDR6zMJEn0IKKceDVQAdPvNtrQ0b5yN46YnAfcrro",
    "hp": "12"
}

- Get inventory summary & detail
http://localhost/api/vehicle_inventory.php (POST)
Raw data required:
{
    "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2NDU0NzU4ODUsImV4cCI6MTY0NTQ3NjE4NSwiaXNzIjoiaHR0cDovL2xvY2FsaG9zdC9hcGkvIiwiZGF0YSI6eyJpZCI6IjEyIiwiZmlyc3RuYW1lIjoiVXNlciA3IiwibGFzdG5hbWUiOiJUZXN0IiwiZW1haWwiOiJ0dXNlcjdAbXllbWFpbC5jb20ifX0.Mu_PSHk43et6bo8UlQVo07AfDspBpmZf2OkgvEFqGmU"
}
```