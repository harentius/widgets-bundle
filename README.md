Widgets Bundle
==============

Symfony Bundle for easy creating and managing client-side widgets.
Has SonataAdminBundle dependency and provide management.

Installation
-----------

1)
```php
$ composer.phar require harentius/widgets-bundle
```

2) Enable bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Harentius\WidgetsBundle\HarentiusWidgetsBundle(),
    );

    // ...
}
```

3) Include configuration:
```yml
imports:
    ....
    - { resource: "@HarentiusWidgetsBundle/Resources/config/config.yml" }
```

4) Configure:
```yml
harentius_widgets:
    # List of routes, where widgets can be placed
    routes:
        acme_homepage:
            # User-friendly name for displaying in admin section (sonata)
            name: Homepage
        acme_blog_show:
            name: Article
            # Parameters, present in route
            parameters:
                slug:
                    # Source (Now only entity supported)
                    source:
                        class: HarentiusBlogBundle:Article
                        # Value to be passed to the route 
                        field: slug
                        # Value to be shown in admin section
                        identity: title
    # Registering widgets: key used in templates (look behind), value - shown in admin section
    widgets:
        widgets_block_sidebar: Sidebar
        widgets_block_bottom_left: Bottom left
        widgets_block_bottom_right: Bottom right
```

5) Place in templates where you want:
```twig
    {{ harentius_widget('widgets_block_sidebar') }}
```
