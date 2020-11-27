<?php

namespace Observatby\FileSharingOnCdn;

use Backend;
use System\Classes\PluginBase;

/**
 * FileSharingOnCdn Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'FileSharingOnCdn',
            'description' => 'No description provided yet...',
            'author'      => 'Observatby',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Observatby\FileSharingOnCdn\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'observatby.filesharingoncdn.some_permission' => [
                'tab' => 'FileSharingOnCdn',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'filesharingoncdn' => [
                'label'       => 'FileSharingOnCdn',
                'url'         => Backend::url('observatby/filesharingoncdn/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['observatby.filesharingoncdn.*'],
                'order'       => 500,
            ],
        ];
    }
}
