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
			self::$instance = self::getServiceClassInstance(get_class());
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
}