<?php
namespace TYPO3\CMS\Extensionmanager\Utility\Importer;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
/**
 * Module: Extension manager - Extension list importer
 *
 * @author Marcus Krause <marcus#exp2010@t3sec.info>
 * @author Steffen Kamper <info@sk-typo3.de>
 */
/**
 * Importer object for extension list
 *
 * @author Marcus Krause <marcus#exp2010@t3sec.info>
 * @author Steffen Kamper <info@sk-typo3.de>
 * @since 2010-02-10
 */
class ExtensionListUtility implements \SplObserver {

	/**
	 * Keeps instance of a XML parser.
	 *
	 * @var \TYPO3\CMS\Extensionmanager\Utility\Parser\AbstractExtensionXmlParser
	 */
	protected $parser;

	/**
	 * Keeps number of processed version records.
	 *
	 * @var integer
	 */
	protected $sumRecords = 0;

	/**
	 * Keeps record values to be inserted into database.
	 *
	 * @var array
	 */
	protected $arrRows = array();

	/**
	 * Keeps fieldnames of tx_extensionmanager_domain_model_extension table.
	 *
	 * @var array
	 */
	static protected $fieldNames = array(
		'extension_key',
		'version',
		'integer_version',
		'current_version',
		'alldownloadcounter',
		'downloadcounter',
		'title',
		'ownerusername',
		'author_name',
		'author_email',
		'authorcompany',
		'last_updated',
		'md5hash',
		'repository',
		'state',
		'review_state',
		'category',
		'description',
		'serialized_dependencies',
		'update_comment'
	);

	/**
	 * Keeps indexes of fields that should not be quoted.
	 *
	 * @var array
	 */
	static protected $fieldIndicesNoQuote = array(2, 3, 5, 11, 13, 14, 15, 16);

	/**
	 * Keeps repository UID.
	 *
	 * The UID is necessary for inserting records.
	 *
	 * @var integer
	 */
	protected $repositoryUid = 1;

	/**
	 * @var \TYPO3\CMS\Extensionmanager\Domain\Repository\RepositoryRepository
	 */
	protected $repositoryRepository;

	/**
	 * @var \TYPO3\CMS\Extensionmanager\Domain\Repository\ExtensionRepository
	 */
	protected $extensionRepository;

	/**
	 * @var \TYPO3\CMS\Extensionmanager\Domain\Model\Extension
	 */
	protected $extensionModel;

	/**
	 * Class constructor.
	 *
	 * Method retrieves and initializes extension XML parser instance.
	 *
	 * @throws \TYPO3\CMS\Extensionmanager\Exception\ExtensionManagerException
	 */
	public function __construct() {
		/** @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager */
		$this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$this->repositoryRepository = $this->objectManager->get('TYPO3\\CMS\\Extensionmanager\\Domain\\Repository\\RepositoryRepository');
		$this->extensionRepository = $this->objectManager->get('TYPO3\\CMS\\Extensionmanager\\Domain\\Repository\\ExtensionRepository');
		$this->extensionModel = $this->objectManager->get('TYPO3\\CMS\\Extensionmanager\\Domain\\Model\\Extension');
		// TODO catch parser exception
		$this->parser = \TYPO3\CMS\Extensionmanager\Utility\Parser\XmlParserFactory::getParserInstance('extension');
		if (is_object($this->parser)) {
			$this->parser->attach($this);
		} else {
			throw new \TYPO3\CMS\Extensionmanager\Exception\ExtensionManagerException(get_class($this) . ': No XML parser available.');
		}
	}

	/**
	 * Method initializes parsing of extension.xml.gz file.
	 *
	 * @param string $localExtensionListFile absolute path to extension list xml.gz
	 * @param integer $repositoryUid UID of repository when inserting records into DB
	 * @return integer total number of imported extension versions
	 */
	public function import($localExtensionListFile, $repositoryUid = NULL) {
		if (!is_null($repositoryUid) && is_int($repositoryUid)) {
			$this->repositoryUid = $repositoryUid;
		}
		$zlibStream = 'compress.zlib://';
		$this->sumRecords = 0;
		$this->parser->parseXML($zlibStream . $localExtensionListFile);
		// flush last rows to database if existing
		if (count($this->arrRows)) {
			$GLOBALS['TYPO3_DB']->exec_INSERTmultipleRows('tx_extensionmanager_domain_model_extension', self::$fieldNames, $this->arrRows, self::$fieldIndicesNoQuote);
		}
		$extensions = $this->extensionRepository->insertLastVersion($this->repositoryUid);
		$this->repositoryRepository->updateRepositoryCount($extensions, $this->repositoryUid);
		return $this->sumRecords;
	}

	/**
	 * Method collects and stores extension version details into the database.
	 *
	 * @param \SplSubject|\TYPO3\CMS\Extensionmanager\Utility\Parser\AbstractExtensionXmlParser &$subject a subject notifying this observer
	 * @return void
	 */
	protected function loadIntoDatabase(\SplSubject &$subject) {
		// flush every 50 rows to database
		if ($this->sumRecords !== 0 && $this->sumRecords % 50 === 0) {
			$GLOBALS['TYPO3_DB']->exec_INSERTmultipleRows('tx_extensionmanager_domain_model_extension', self::$fieldNames, $this->arrRows, self::$fieldIndicesNoQuote);
			$this->arrRows = array();
		}
		$versionRepresentations = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionStringToArray($subject->getVersion());
		// order must match that of self::$fieldNames!
		$this->arrRows[] = array(
			$subject->getExtkey(),
			$subject->getVersion(),
			$versionRepresentations['version_int'],
			// initialize current_version, correct value computed later:
			0,
			(int)$subject->getAlldownloadcounter(),
			(int)$subject->getDownloadcounter(),
			!is_null($subject->getTitle()) ? $subject->getTitle() : '',
			$subject->getOwnerusername(),
			!is_null($subject->getAuthorname()) ? $subject->getAuthorname() : '',
			!is_null($subject->getAuthoremail()) ? $subject->getAuthoremail() : '',
			!is_null($subject->getAuthorcompany()) ? $subject->getAuthorcompany() : '',
			(int)$subject->getLastuploaddate(),
			$subject->getT3xfilemd5(),
			$this->repositoryUid,
			$this->extensionModel->getDefaultState($subject->getState() ?: ''),
			(int)$subject->getReviewstate(),
			$this->extensionModel->getCategoryIndexFromStringOrNumber($subject->getCategory() ?: ''),
			$subject->getDescription() ?: '',
			$subject->getDependencies() ?: '',
			$subject->getUploadcomment() ?: ''
		);
		++$this->sumRecords;
	}

	/**
	 * Method receives an update from a subject.
	 *
	 * @param \SplSubject $subject a subject notifying this observer
	 * @return void
	 */
	public function update(\SplSubject $subject) {
		if (is_subclass_of($subject, 'TYPO3\\CMS\\Extensionmanager\\Utility\\Parser\\AbstractExtensionXmlParser')) {
			$this->loadIntoDatabase($subject);
		}
	}

}
