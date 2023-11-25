# Course php 

1. Installation php 
MAC

Example:
$ curl -s https://php-osx.liip.ch/install.sh | bash -s 7.3
$ curl -s https://php-osx.liip.ch/install.sh | bash -s 7.2
$ curl -s https://php-osx.liip.ch/install.sh | bash -s 7.1
$ curl -s https://php-osx.liip.ch/install.sh | bash -s 7.0
$ curl -s https://php-osx.liip.ch/install.sh | bash -s 5.6
$ curl -s https://php-osx.liip.ch/install.sh | bash -s 5.5

2. $ php -v
3. $ touch ~/.profile (create file named .profile inside /usr/home )
add next line inside .profile 

export PATH=/usr/local/php7.2/bin:$PATH


WINDOWS
download php
C:\ Programs Files \ PHP (create folder php)

add to the system via environments variables in windows

C:\Program Files\PHP



LINUX

$ sudo apt install php-cli
$ sudo apt install php-curl





$ php -S localhost:8000 -t public -d error_reporting=E_ALL