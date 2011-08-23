<?php
/**
 * @package modules.marker
 */
class markergmaps_MarkergmapsService extends website_MarkerService
{
	/**
	 * @var markergmaps_MarkergmapsService
	 */
	private static $instance;

	/**
	 * @return markergmaps_MarkergmapsService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * @return markergmaps_persistentdocument_markergmaps
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/markergmaps');
	}

	/**
	 * Create a query based on 'modules_markergmaps/markergmaps' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/markergmaps');
	}
	
	/**
	 * @param markergmaps_persistentdocument_markergmaps $document
	 * @param string $actionType
	 * @param array $formProperties
	 */
	public function addFormProperties($document, $propertiesNames, &$formProperties)
	{
		parent::addFormProperties($document, $propertiesNames, $formProperties);
		$formProperties['signupUrl'] = 'http://code.google.com/apis/maps/signup.html';
	}
	
	/**
	 * @param markergmaps_persistentdocument_markergmaps $document
	 * @param string $forModuleName
	 * @param array $allowedSections
	 * @return array
	 */
	public function getResume($document, $forModuleName, $allowedSections = null)
	{
		$data = parent::getResume($document, $forModuleName, $allowedSections);
		$data['properties']['signupUrl'] = 'http://code.google.com/apis/maps/signup.html';
		return $data;
	}
}