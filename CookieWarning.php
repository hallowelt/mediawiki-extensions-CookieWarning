<?php

$wgExtensionCredits['other'] = array(
	"name" => "CookieWarning",
	"version" => "0.1.0",
	"author" => array(
		"Florian Schmidt"
	),
	"url" => "https://www.droidwiki.de",
	"descriptionmsg" => "cookiewarning-desc",
	"type" => "other",
	"license-name" => "MIT",
);

$wgMessagesDirs['CookieWarning'] = __DIR__ . '/i18n';

$wgHooks["SkinTemplateOutputPageBeforeExec"][] = "CookieWarningHooks::onSkinTemplateOutputPageBeforeExec";
$wgHooks["BeforePageDisplay"][] = "CookieWarningHooks::onBeforePageDisplay";
$wgHooks["GetPreferences"][] = "CookieWarningHooks::onGetPreferences";
$wgHooks["BeforeInitialize"][] = "CookieWarningHooks::onBeforeInitialize";

$wgCookieWarningEnabled = false;
$wgCookieWarningMoreUrl = "";

$wgDefaultUserOptions['cookiewarning_dismissed'] = false;

$resourceModuleTemplate = array(
	'localBasePath' => $IP.'/extensions/CookieWarning/resources',
	'remoteExtPath' => 'CookieWarning/resources',
);

$wgResourceModules['ext.CookieWarning'] = array(
	'scripts' => array(
		'ext.CookieWarning/ext.CookieWarning.js'
	),
	"dependencies" => array(
		"mediawiki.api",
		"jquery.cookie"
	),
	"targets" => array(
		"mobile",
		"desktop"
	),
) + $resourceModuleTemplate;

$wgResourceModules["ext.CookieWarning.styles"] = array(
	"position" => "top",
	'styles' => array(
		'ext.CookieWarning/ext.CookieWarning.css'
	),
	"targets" => array(
		"mobile",
		"desktop"
	),
) + $resourceModuleTemplate;

$wgAutoloadClasses['CookieWarningHooks'] = __DIR__ . '/includes/CookieWarning.hooks.php';

unset( $resourceModuleTemplate );

