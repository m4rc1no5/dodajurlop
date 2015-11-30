dodajurlop
==========

[![Build Status](https://travis-ci.org/m4rc1no5/dodajurlop.svg?branch=master)](https://travis-ci.org/m4rc1no5/dodajurlop) 
[![codecov.io](https://codecov.io/github/m4rc1no5/dodajurlop/coverage.svg?branch=master)](https://codecov.io/github/m4rc1no5/dodajurlop?branch=master)

Documentation
=============

Table of contents
-----------------

1. [Installation](#installation)
2. [Setting up permissions](#permission)

<a name="installation"></a>
Installation
------------

### Clone the project

```
git@github.com:m4rc1no5/dodajurlop.git
```

### Update packages

```
cd dodajurlop
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

### Setting up .htaccess (if You use Apache)

If You use prod machine:

```bash
cp web/.htaccess.prod web/.htaccess
```

If You use dev machine:

```bash
cp web/.htaccess.dev web/.htaccess
```

### Setting up Nginx config (if You use Nginx)

```
server {
    server_name dodajurlop.lh www.dodajurlop.lh;
    root /path/to/web/folder;

    location / {
        # try to serve file directly, fallback to app.php
        try_files $uri /app_dev.php$is_args$args;
	    #try_files $uri /app.php;
    }
    # DEV
    # This rule should only be placed on your development environment
    # In production, don't include this and don't deploy app_dev.php or config.php
    location ~ ^/(app_dev|config)\.php(/|$) {
        fastcgi_pass unix:/var/run/php5-fpm.sock;
	    #fastcgi_pass 127.0.0.1:9000;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
    # PROD
    #location ~ ^/app\.php(/|$) {
    #    fastcgi_pass unix:/var/run/php5-fpm.sock;
    #    fastcgi_split_path_info ^(.+\.php)(/.*)$;
    #    include fastcgi_params;
    #    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    #    # Prevents URIs that include the front controller. This will 404:
    #    # http://domain.tld/app.php/some-path
    #    # Remove the internal directive to allow URIs like this
    #    internal;
    #}

    error_log /var/log/nginx/dodajurlop_error.log;
    access_log /var/log/nginx/dodajurlop_access.log;
}
```

### Create database

To create database in PostgreSQL first You must login to database:

```
psql -U postgres template1
```

and then create database, user and set permissions:

```sql
CREATE DATABASE example_database_name;
CREATE USER example_username WITH PASSWORD 'example_password';
GRANT ALL ON DATABASE example_database_name TO example_username;
```

### Modyfy config

To connect with database and send email You must modify file parameters.yml

### Create database schema

```
app/console doctrine:schema:create
```

### Create and activate user

```
php app/console fos:user:create
php app/console fos:user:activate
```

### Setting up permissions

Folders app/cache and app/logs directories must be writable - see [Setting up permissions](#permission)

### Load Doctrine fixtues data

```
php app/console doctrine:fixtures:load
```

More info: http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html

<a name="permission"></a>
Setting up permissions
----------------------

One common issue when installing Symfony is that the app/cache and app/logs directories must be writable both by the web server and the command line user. On a UNIX system, if your web server user is different from your command line user, you can try one of the following solutions.

### Use the same user for the CLI and the web server

In development environments, it is a common practice to use the same UNIX user for the CLI and the web server because it avoids any of these permissions issues when setting up new projects. This can be done by editing your web server configuration (e.g. commonly httpd.conf or apache2.conf for Apache) and setting its user to be the same as your CLI user (e.g. for Apache, update the User and Group values).

### Using ACL on a system that supports chmod +a

Many systems allow you to use the chmod +a command. Try this first, and if you get an error - try the next method. This uses a command to try to determine your web server user and set it as HTTPDUSER:

```bash
    rm -rf app/cache/*
    rm -rf app/logs/*

    HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
    sudo chmod +a "$HTTPDUSER allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
    sudo chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
```

### Using ACL on a system that does not support chmod +a

Some systems don't support chmod +a, but do support another utility called setfacl. You may need to enable ACL support on your partition and install setfacl before using it (as is the case with Ubuntu). This uses a command to try to determine your web server user and set it as HTTPDUSER:

```bash
    HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
    sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
    sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
```

If this doesn't work, try adding -n option.

### Without using ACL

If none of the previous methods work for you, change the umask so that the cache and log directories will be group-writable or world-writable (depending if the web server user and the command line user are in the same group or not). To achieve this, put the following line at the beginning of the app/console, web/app.php and web/app_dev.php files:

```bash
    umask(0002); // This will let the permissions be 0775

    // or

    umask(0000); // This will let the permissions be 0777
```

Note that using the ACL is recommended when you have access to them on your server because changing the umask is not thread-safe.

http://symfony.com/doc/current/book/installation.html#configuration-and-setup
