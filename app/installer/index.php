<?php

use Atomcms\Installer\Package\PackageFactory;
use Atomcms\Kernel\Exception\NotFoundException;

return [

    'name' => 'installer',

    'main' => function ($app) {

        $app['package'] = function ($app) {
            return (new PackageFactory())->addPath($app['path'].'/packages/*/*/composer.json');
        };

        if ($this->config['enabled']) {

            $app->extend('assets', function ($factory) use ($app) {

                $factory->setVersion($app['version']);

                return $factory;

            });

            $app['routes']->add([
                'path' => '/installer',
                'name' => '@installer',
                'controller' => 'Atomcms\Installer\Controller\InstallerController'
            ]);

            $app->on('request', function ($event, $request) use ($app) {

                $locale = $request->get('locale') ?: $app['request']->getPreferredLanguage();
                $available = $app->module('system/intl')->getAvailableLanguages();

                if (isset($available[$locale])) {
                    $app->module('system/intl')->setLocale($locale);
                }

            });

            $app->error(function (NotFoundException $e) use ($app) {
                return $app['response']->redirect('@installer');
            });

        }

    },

    'require' => [

        'application',
        'system/cache',
        'system/intl',
        'system/view'

    ],

    'routes' => [

        '/system/package' => [
            'name' => '@system/package',
            'controller' => 'Atomcms\Installer\Controller\PackageController'
        ],
        '/system/marketplace' => [
            'name' => '@system/marketplace',
            'controller' => 'Atomcms\Installer\Controller\MarketplaceController'
        ],
        '/system/update' => [
            'name' => '@system/update',
            'controller' => 'Atomcms\Installer\Controller\UpdateController'
        ]

    ],

    'languages' => '/../system/languages',

    'resources' => [

        'installer:' => ''

    ],

    'permissions' => [

        'system: manage packages' => [
            'title' => 'Manage extensions and themes',
            'description' => 'Manage extensions and themes'
        ],
        'system: software updates' => [
            'title' => 'Apply system updates',
            'trusted' => true
        ]

    ],

    'menu' => [

        'system: marketplace' => [
            'label' => 'Marketplace',
            'icon' => 'installer:assets/images/icon-marketplace.svg',
            'url' => '@system/marketplace/extensions',
            'access' => 'system: manage packages',
            'priority' => 125
        ],

        'system: marketplace extensions' => [
            'label' => 'Extensions',
            'parent' => 'system: marketplace',
            'url' => '@system/marketplace/extensions'
        ],

        'system: marketplace themes' => [
            'label' => 'Themes',
            'parent' => 'system: marketplace',
            'url' => '@system/marketplace/themes'
        ],

        'system: extensions' => [
            'label' => 'Extensions',
            'parent' => 'system: system',
            'url' => '@system/package/extensions',
            'access' => 'system: manage packages',
            'priority' => 5
        ],

        'system: themes' => [
            'label' => 'Themes',
            'parent' => 'system: system',
            'url' => '@system/package/themes',
            'access' => 'system: manage packages',
            'priority' => 10
        ],

        'system: update' => [
            'label' => 'Update',
            'parent' => 'system: system',
            'url' => '@system/update',
            'priority' => 25
        ]

    ],

    'config' => [

        'enabled' => false,
        'release_channel' => 'stable'

    ]

];
