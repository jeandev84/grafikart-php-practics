##  MicroLaventure

### About 
```
 MicroLaventure is a simple microframework for building simple web site
```

### Installation 

1. Lunch composer
```bash
composer require install
```

2. Configuration Database ```./config/app```
- Using PDO connection 

```php 
<?php

return [
   'database' => [
       'dsn' => 'mysql:host=YOUR_HOST;dbname=YOUR_DATABASE;charset=utf8',
       'username' => YOUR_USERNAME,
       'password' => YOUR_PASSWORD,
       'options' => [
           #PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
       ],
   ]
];
```


3. Create database via command
```bash
php bin/console.php database:create --db=YOUR_DATABASE
```


4. Run Server on port ```:8080```
- http://localhost:8080
```bash 
php server.php
```