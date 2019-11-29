<?php

namespace Analytics\Config;

class PluginActivation
{

    public function beforeActivation()
    {
        return true;
    }

    public function onActivation()
    {
        $settings = \Cake\ORM\TableRegistry::get('Croogo/Settings.Settings');
        $settings->write('Site.Analytics.webPropertyId', '', [
            'editable' => 1,
            'title' => 'Web Property ID',
            'description' => 'Enter your site Web Property ID (mutually exclusive to Measurement ID)',
        ]);

        $settings->write('Site.Analytics.measurementId', '', [
            'editable' => 1,
            'title' => 'Measurement ID',
            'description' => 'Enter your site Measurement ID (mutually exclusive to Web Property Id)',
        ]);

        $settings->write('Site.Analytics.domain', '', [
            'editable' => 1,
            'title' => 'Primary Domain',
            'description' => 'If you\'re using multiple subdomains, enter your primary domain name here',
        ]);
    }

    public function beforeDeactivation()
    {
        return true;
    }

    public function onDeactivation()
    {
        $settings = \Cake\ORM\TableRegistry::get('Croogo/Settings.Settings');
        $settings->deleteKey('Site.Analytics.webPropertyId');
        $settings->deleteKey('Site.Analytics.domain');
    }

}
