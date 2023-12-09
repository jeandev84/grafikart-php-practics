### Grafikart framework

- UUID
- https://github.com/ramsey/uuid


GIT
```
$ git status
$ git add .
$ git commit --amend
$ git log --all --decorate --oneline --graph
```

1. Lunch Tests 
```
$ ./vendor/bin/phpunit tests/Framework/AppTest.php
```

2. PHP Code Sniffer 
```
https://github.com/squizlabs/PHP_CodeSniffer
$ env ENV=dev ./vendor/bin/phpcs src/Framework/App.php
$ env ENV=dev ./vendor/bin/phpcbf
```

./vendor/bin/phpunit; ./vendor/bin/phpcs



3. Phinx 
```
$ ./vendor/bin/phinx init .
$ $EDITOR phinx.yml
$ mkdir -p db/migrations db/seeds
$ ./vendor/bin/phnix create MyFirstMigration
$ ./vendor/bin/phinx create CreatePostsTable
$ ./vendor/bin/phinx migrate -e development [ vendor/bin/phinx migrate ]
$ ./vendor/bin/phinx seed:create MyNewSeeder
$ ./vendor/bin/phinx seed:run
```

4. Refresh Migration 
```
$ ./vendor/bin/phinx rollback -t 0
$ ./vendor/bin/phinx migrate
$ ./vendor/bin/phinx seed:run
```

5. Pagerfanta 
```
https://github.com/whiteoctober/Pagerfanta
```


6. Lunch Server and Activate OPCache en mode CLI
```
$ php -S localhost:8000 -t ./public -d display_errors=1 -d opcache.enable_cli=1
$ env ENV=dev php -S localhost:8000 -t public -d display_errors=1 -d opcache.enable_cli=1
```

7. QueryBuilder example 
```
https://github.com/envms/fluentpdo
```

8. Upload Images 
```
https://github.com/intervention/image
$ composer require intervention/image
```



9. PHPUnit 
```
<!-- https://phpunit.de/documentation.html
env ENV=dev ./vendor/bin/phpunit --coverage-text
==================================================================
Exporter le coverage dans un fichier:
env ENV=dev ./vendor/bin/phpunit -coverage-html ./tmp
==================================================================
env ENV=dev ./vendor/bin/phpunit --stop-on-error
env ENV=dev ./vendor/bin/phpunit --stop-on-failure
-->
````





