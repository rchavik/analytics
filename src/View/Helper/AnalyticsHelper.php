<?php
namespace Analytics\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

/**
 * Class AnalyticsHelper
 *
 * @property \Cake\View\Helper\HtmlHelper $Html
 */
class AnalyticsHelper extends Helper
{
    public $helpers = ['Html'];

    public function beforeRender()
    {
        $webPropertyId = Configure::read('Site.Analytics.webPropertyId');
        if ($webPropertyId) {
            $script =<<<EOF
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', '{$webPropertyId}', 'auto');
  ga('send', 'pageview');
EOF;
        }
        $measurementId = Configure::read('Site.Analytics.measurementId');
        if (!$webPropertyId && $measurementId) {

            $this->Html->script('//www.googletagmanager.com/gtag/js?id=' . $measurementId, [
                'block' => true,
                'async' => true,
            ]);
            $script =<<<EOF
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{$measurementId});
EOF;
        }

        $this->Html->scriptBlock($script, ['block' => true]);
    }
}
