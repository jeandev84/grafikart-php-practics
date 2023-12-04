<?php

date_default_timezone_set('Europe/Moscow');

/*
 setcookie(name, value, expires = time() + 60 * 60 * 24, domain = 'http://127.0.0.1:8000', secure = false, httpOnly = false)

 name     : Nom du cookie
 value    : Valeur du cookie
 expires  : Date d' expiration deu cookie
 domain   : Domain sur lequel sera definit le cookie
 secure   : si le cookie sera accessible par le protocol http / https
 httpOnly : si le cookie sera accessible par javascript etc...
*/


// 1min  = 60 s
// 1h    = 60 min
// 1j    = 24h

// 1j    = 24 * 60 * 60 (s)
// 30j   = 30 * 24 * 60 * 60 (s)

// (timestamp du jour depuis 1 Janvier 1970) time() + 60 * 60 * 24 = 1jour
// setcookie('username', 'John', time() + 60 * 60 * 24);


echo '<pre>';
print_r($_COOKIE);
echo '</pre>';