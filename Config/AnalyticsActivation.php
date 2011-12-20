<?php

class AnalyticsActivation {

	public function beforeActivation($controller) {
		return true;
	}

	public function onActivation($controller) {

		$controller->Setting->write('Site.Analytics.webPropertyId', '', array(
			'editable' => 1,
			'title' => 'Web Property ID',
			'description' => 'Enter your site Web Property ID',
			));

		$controller->Setting->write('Site.Analytics.domain', '', array(
			'editable' => 1,
			'title' => 'Primary Domain',
			'description' => 'If you\'re using multiple subdomains, enter your primary domain name here',
			));

	}

	public function beforeDeactivation($controller) {
		return true;
	}

	public function onDeactivation($controller) {
		$controller->Setting->deleteKey('Site.Analytics');
	}

}
