<?php

# Functions
if (! function_exists('e')) {
    function e(string $string): string {
        return htmlentities($string);
    }
}
