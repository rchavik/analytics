<?php

class AnalyticsHelper extends AppHelper {

	public $helpers = array('Html');

	public function beforeRender() {
		$webPropertyId = Configure::read('Site.Analytics.webPropertyId');
		if (empty($webPropertyId)) {
			return;
		}
		$domain = Configure::read('Site.Analytics.domain');
		$identString  = "_gaq.push(['_setAccount', '$webPropertyId']);";
		if (!empty($domain)) {
			$identString .= "_gaq.push(['_setDomainName', '$domain']);";
		}
		$script = sprintf("var _gaq = _gaq || []; %s _gaq.push(['_setAllowLinker', true]); _gaq.push(['_trackPageview']);
(function() {
	var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();", $identString);

		$this->Html->scriptBlock($script, array('inline' => false));
	}

}
