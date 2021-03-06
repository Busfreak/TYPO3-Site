<?php
return array(
	'BE' => array(
		'debug' => FALSE,
		'explicitADmode' => 'explicitAllow',
		'installToolPassword' => '$1$4NeYGT76$J1.C7nI6wYyMFonZ621Rn0',
		'loginSecurityLevel' => 'rsa',
		'versionNumberInFilename' => '0',
	),
	'EXT' => array(
		'extConf' => array(
			'autoswitchtolistview' => 'a:0:{}',
			'beuser' => 'a:0:{}',
			'devlog' => 'a:12:{s:10:"maxLogRuns";s:2:"15";s:14:"entriesPerPage";s:2:"25";s:7:"maxRows";s:4:"1000";s:8:"optimize";s:1:"0";s:8:"dumpSize";s:7:"1000000";s:11:"minLogLevel";s:2:"-1";s:11:"excludeKeys";s:0:"";s:14:"highlightStyle";s:60:"padding: 2px; background-color: #fc3; border: 1px solid #666";s:16:"refreshFrequency";s:1:"2";s:13:"prototypePath";s:0:"";s:11:"autoCleanup";s:1:"0";s:8:"__meta__";N;}',
			'fed' => 'a:9:{s:29:"enableBackendRecordController";s:1:"0";s:24:"enableFluidPageTemplates";s:1:"0";s:42:"enableFluidPageTemplateVariableInheritance";s:1:"0";s:31:"enableFallbackFluidPageTemplate";s:1:"0";s:18:"enableSolrFeatures";s:1:"0";s:21:"enableFrontendPlugins";s:1:"0";s:30:"enableIntegratedBackendLayouts";s:1:"0";s:28:"increaseExtbaseCacheLifetime";s:1:"0";s:35:"disableAutomaticTypoScriptInclusion";s:1:"0";}',
			'fluidcontent' => 'a:0:{}',
			'fluidcontent_bootstrap' => 'a:0:{}',
			'fluidpages' => 'a:2:{s:8:"autoload";s:1:"1";s:8:"doktypes";s:0:"";}',
			'flux' => 'a:4:{s:9:"debugMode";s:1:"0";s:15:"disableCompiler";s:1:"0";s:7:"compact";s:1:"0";s:12:"handleErrors";s:1:"0";}',
			'gridelements' => 'a:0:{}',
			'realurl' => 'a:5:{s:10:"configFile";s:26:"typo3conf/realurl_conf.php";s:14:"enableAutoConf";s:1:"1";s:14:"autoConfFormat";s:1:"0";s:12:"enableDevLog";s:1:"0";s:19:"enableChashUrlDebug";s:1:"0";}',
			'recycler' => 'a:0:{}',
			'rsaauth' => 'a:1:{s:18:"temporaryDirectory";s:0:"";}',
			'rtehtmlarea' => 'a:8:{s:21:"noSpellCheckLanguages";s:23:"ja,km,ko,lo,th,zh,b5,gb";s:15:"AspellDirectory";s:15:"/usr/bin/aspell";s:20:"defaultConfiguration";s:120:"Minimal (Most features disabled. Administrator needs to enable them using TypoScript. For advanced administrators only.)";s:12:"enableImages";s:1:"1";s:20:"enableInlineElements";s:1:"0";s:19:"allowStyleAttribute";s:1:"1";s:24:"enableAccessibilityIcons";s:1:"0";s:16:"forceCommandMode";s:1:"0";}',
			'saltedpasswords' => 'a:2:{s:3:"FE.";a:2:{s:7:"enabled";s:1:"1";s:21:"saltedPWHashingMethod";s:28:"tx_saltedpasswords_salts_md5";}s:3:"BE.";a:1:{s:21:"saltedPWHashingMethod";s:28:"tx_saltedpasswords_salts_md5";}}',
			'seo_basics' => 'a:2:{s:10:"xmlSitemap";s:1:"1";s:16:"sourceFormatting";s:1:"1";}',
			'template' => 'a:0:{}',
			'vhs' => 'a:0:{}',
			'ws_less' => 'a:0:{}',
		),
	),
	'EXTCONF' => array(
		'lang' => array(
			'availableLanguages' => array(
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'de',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
			),
		),
	),
	'FE' => array(
		'activateContentAdapter' => FALSE,
		'debug' => FALSE,
		'loginSecurityLevel' => 'rsa',
	),
	'GFX' => array(
		'jpg_quality' => '100',
	),
	'INSTALL' => array(
		'wizardDone' => array(
			'TYPO3\CMS\Install\Updates\FileIdentifierHashUpdate' => 1,
			'TYPO3\CMS\Install\Updates\FilemountUpdateWizard' => 1,
			'TYPO3\CMS\Install\Updates\TceformsUpdateWizard' => 'tt_content:image,pages:media,pages_language_overlay:media',
			'TYPO3\CMS\Install\Updates\TruncateSysFileProcessedFileTable' => 1,
		),
	),
	'SYS' => array(
		'caching' => array(
			'cacheConfigurations' => array(
				'extbase_object' => array(
					'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
					'frontend' => 'TYPO3\\CMS\\Core\\Cache\\Frontend\\VariableFrontend',
					'groups' => array(
						'system',
					),
					'options' => array(
						'defaultLifetime' => 0,
					),
				),
			),
		),
		'clearCacheSystem' => FALSE,
		'compat_version' => '6.2',
		'curlUse' => '1',
		'devIPmask' => '',
		'displayErrors' => 0,
		'enableDeprecationLog' => FALSE,
		'encryptionKey' => '84b5246fb2c443002224b20510ea5cd1ecdff6464b513cd95c56829c6df8904ff06d78eca41d81dd6fa971501f358b52',
		'isInitialInstallationInProgress' => FALSE,
		'sitename' => 'New TYPO3 site',
		'sqlDebug' => 0,
		'systemLogLevel' => 2,
		't3lib_cs_convMethod' => 'mbstring',
		't3lib_cs_utils' => 'mbstring',
	),
);
?>