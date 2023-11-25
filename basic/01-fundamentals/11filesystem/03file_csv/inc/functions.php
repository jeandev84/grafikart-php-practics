<?php


/**
 * @param string $filename
 * @param mixed $content
 * @param int $flags
 * @return false|int
*/
function write(string $filename, $content, int $flags = 0) {
     return file_put_contents($filename, $content, $flags);
}


/**
 * @param $filename
 * @return false|string
*/
function read($filename) {
     return file_get_contents($filename);
}






