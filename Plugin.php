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
            'name' => 'FileSharingOnCdn',
            'description' => 'Temporary file sharing on CDN',
            'author' => 'Observatby',
            'homepage' => 'https://github.com/Observat/FileSharingOnCdn',
            'icon' => 'icon-leaf'
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
        return [];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
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
        return [
            'filesharingoncdn' => [
                'label' => 'observatby.filesharingoncdn::lang.menu.filelinks',
                'url' => Backend::url('observatby/filesharingoncdn/filelinks'),
                'icon' => 'icon-leaf',
                'permissions' => ['observatby.filesharingoncdn.*'],
                'order' => 500,
                'sideMenu' => [
                    'new_filelink' => [
                        'label'       => 'observatby.filesharingoncdn::lang.menu.add_filelink',
                        'icon'        => 'icon-plus',
                        'url'         => Backend::url('observatby/filesharingoncdn/filelinks/create'),
                    ],
                    'filelinks' => [
                        'label'       => 'observatby.filesharingoncdn::lang.menu.filelinks',
                        'icon'        => 'icon-file-image-o',
                        'url'         => Backend::url('observatby/filesharingoncdn/filelinks'),
                    ],
                ],
            ],
        ];
    }
}
