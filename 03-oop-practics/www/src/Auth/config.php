<?php

use App\Auth\Security\DatabaseAuth;
use Framework\Security\Auth;

return [
  Auth::class => \DI\get(DatabaseAuth::class)
];