<?php
shell_exec('php -S localhost:8000 -t public -d display_errors=1 -d opcache.enable_cli=1');