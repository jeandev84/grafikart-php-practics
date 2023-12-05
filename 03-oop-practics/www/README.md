### Grafikart framework


1. Lunch Tests 
```
$ ./vendor/bin/phpunit tests/Framework/AppTest.php
```

2. PHP Code Sniffer 
```
https://github.com/squizlabs/PHP_CodeSniffer
$ ./vendor/bin/phpcs src/Framework/App.php
```

./vendor/bin/phpunit; ./vendor/bin/phpcs



3. Phinx 
```
$ ./vendor/bin/phinx init .
$ $EDITOR phinx.yml
$ mkdir -p db/migrations db/seeds
$ vendor/bin/phnix create MyFirstMigration
$ vendor/bin/phinx create CreatePostsTable
$ vendor/bin/phinx migrate -e development [ vendor/bin/phinx migrate ]
$ vendor/bin/phinx seed:create MyNewSeeder
$ vendor/bin/phinx seed:run
```


Pagerfanta 
```
https://github.com/whiteoctober/Pagerfanta
```