<?php

/**
 * @return \App\Database\Connection\PdoConnection
 * @throws \App\Database\Connection\Exception\ConnectionException
 */
function getPdo(): \App\Database\Connection\PdoConnection {
    return \App\Database\Connection\ConnectionFactory::make();
}


/**
 * @param string|null $value
 * @return string
 */
function h(?string $value): string {
    if ($value === null) {
        return '';
    }
    return htmlentities($value);
}

function render(string $view, array $params = []): void {
    extract($params);
    include "../views/{$view}.php";
}


/**
 * @return void
 */
function e404(): void {
    require '../public/404.php';
    exit;
}