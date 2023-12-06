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
```

GIT 
```
$ git status
$ git add .
$ git commit --amend
$ git log --all --decorate --oneline --graph
```



