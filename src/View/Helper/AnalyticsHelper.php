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
        if (empty($webPropertyId)) {
            return;
        }
        $identString = "ga('create', '{$webPropertyId}', 'auto');";
        $script = "  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  {$identString}
  ga('send', 'pageview');
";

        $this->Html->scriptBlock($script, ['block' => true]);
    }
}
