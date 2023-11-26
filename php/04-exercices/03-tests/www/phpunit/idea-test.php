<?php

Use App\URLHelper;

require 'vendor/autoload.php';

if (URLHelper::withParam([], 'k', 3) !== "k=3") {
    throw new Exception("Problem assertion.");
}


if (URLHelper::withParam([], 'k', [3, 2, 1]) !== "k=3,2,1") {
    throw new Exception("Problem assertion.");
}
