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
        $domain = Configure::read('Site.Analytics.domain');
        $identString = "_gaq.push(['_setAccount', '$webPropertyId']);";
        if (!empty($domain)) {
            $identString .= "_gaq.push(['_setDomainName', '$domain']);";
        }
        $script = sprintf("var _gaq = _gaq || []; %s _gaq.push(['_setAllowLinker', true]); _gaq.push(['_trackPageview']);
(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();", $identString);

        $this->Html->scriptBlock($script, ['block' => true]);
    }
}
