<?php

return [
    /**
     * Default route to see the UML diagram.
     */
    'route' => '/uml',
    
    /**
     * You can turn on or off the indexing of specific types
     * of classes. By default, LTU processes only controllers 
     * and models.
     */
    'casts'         => false,
    'channels'      => false,
    'commands'      => false,
    'components'    => false,
    'controllers'   => true,
    'events'        => false,
    'exceptions'    => false,
    'jobs'          => false,
    'listeners'     => false,
    'mails'         => false,
    'middlewares'   => false,
    'models'        => true,
    'notifications' => false,
    'observers'     => false,
    'policies'      => false,
    'providers'     => false,
    'requests'      => true,
    'resources'     => false,
    'rules'         => false,
    'routes'        => true,

    /**
     * You can define specific nomnoml styling.
     * For more information: https://github.com/skanaar/nomnoml
     */
    'style' => [
        'background' => '#ffffff',
        'stroke'     => '#212121',
        'arrowSize'  => 0.5,
        'bendSize'   => 0.1,
        'direction'  => 'down',
        'gutter'     => 20,
        'edgeMargin' => 0,
        'gravity'    => 1,
        'edges'      => 'rounded',
        'fill'       => '#ffffff',
        'fillArrows' => false,
        'font'       => 'Calibri',
        'fontSize'   => 12,
        'leading'    => 1.25,
        'lineWidth'  => 1,
        'padding'    => 8,
        'spacing'    => 50,
        'title'      => 'Filename',
        'zoom'       => 1,
        'acyclicer'  => 'none',
        'ranker'     => 'network-simplex'
    ],

    /**
     * Specific files can be excluded if need be.
     * By default, all default Laravel classes are ignored.
     */
    'excludeFiles' => [
        'Http/Kernel.php',
        'Console/Kernel.php',
        'Exceptions/Handler.php',
        'Http/Controllers/Controller.php',
        'Http/Middleware/Authenticate.php',
        'Http/Middleware/EncryptCookies.php',
        'Http/Middleware/PreventRequestsDuringMaintenance.php',
        'Http/Middleware/RedirectIfAuthenticated.php',
        'Http/Middleware/TrimStrings.php',
        'Http/Middleware/TrustHosts.php',
        'Http/Middleware/TrustProxies.php',
        'Http/Middleware/VerifyCsrfToken.php',
        'Providers/AppServiceProvider.php',
        'Providers/AuthServiceProvider.php',
        'Providers/BroadcastServiceProvider.php',
        'Providers/EventServiceProvider.php',
        'Providers/RouteServiceProvider.php',
    ],

    /**
     * In case you changed any of the default directories
     * for different classes, please amend below.
     */
    'directories' => [
        'casts'         => 'Casts/',
        'channels'      => 'Broadcasting/',
        'commands'      => 'Console/Commands/',
        'components'    => 'View/Components/',
        'controllers'   => 'Http/Controllers/',
        'events'        => 'Events/',
        'exceptions'    => 'Exceptions/',
        'jobs'          => 'Jobs/',
        'listeners'     => 'Listeners/',
        'mails'         => 'Mail/',
        'middlewares'   => 'Http/Middleware/',
        'models'        => 'Models/',
        'notifications' => 'Notifications/',
        'observers'     => 'Observers/',
        'policies'      => 'Policies/',
        'providers'     => 'Providers/',
        'requests'      => 'Http/Requests/',
        'resources'     => 'Http/Resources/',
        'rules'         => 'Rules/',
        'routes'        => 'routes/'
    ],
];