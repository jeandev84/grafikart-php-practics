<?php

use App\Auth\Security\DatabaseAuth;
use Framework\Security\Auth;

return [
  'auth.login' => '/login', // authentication path
  Auth::class  => \DI\get(DatabaseAuth::class)
];