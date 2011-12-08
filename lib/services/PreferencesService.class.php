<?php
class markergmaps_PreferencesService extends f_persistentdocument_DocumentService
{
	/**
	 * @var markergmaps_PreferencesService
	 */
	private static $instance;

	/**
	 * @return markergmaps_PreferencesService
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
	 * @return markergmaps_persistentdocument_preferences
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/preferences');
	}

	/**
	 * Create a query based on 'modules_markergmaps/preferences' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->getPersistentProvider()->createQuery('modules_markergmaps/preferences');
	}

	/**
	 * @param markergmaps_persistentdocument_preferences $document
	 * @param Integer $parentNodeId Parent node ID where to save the document (optionnal => can be null !).
	 * @return void
	 */
	protected function preSave($document, $parentNodeId = null)
	{
		$document->setLabel('markergmaps');
	}
}