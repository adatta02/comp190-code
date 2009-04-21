#!/bin/sh
export PHP_FCGI_MAX_REQUESTS=5000
exec /usr/lib/php5/bin/php-cgi

