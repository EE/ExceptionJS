Bundle catches javascript errors and saves them in server logs

*Work in progress, not ready for production usage*


### Installation

Download EEExceptionJSBundle using composer

Add EEExceptionJSBundle in your composer.json:

```
{
    "require": {
        "ee/exceptionjs-bundle": "dev-master"
    }
}
```

Tell composer to download the bundle by running the command:

```
$ php composer.phar update ee/exceptionjs-bundle
```

Composer will install the bundle to your project's vendor/ee directory.

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new EE\ExceptionJSBundle\EEExceptionJSBundle(),
    );
}

```

Add at the beginning of app/config/routing.yml

``` yml

    ee_exceptionjs_bundle:
        resource: "@EEExceptionJSBundle/Resources/config/routing.yml"
        prefix:   /

```


In your base layout include once

``` twig

    {% include 'EEExceptionJSBundle::catcher.html.twig' %}

```
