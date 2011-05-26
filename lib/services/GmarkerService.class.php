<?php
/**
 * markergmaps_GmarkerService
 * @package modules.markergmaps
 */
class markergmaps_GmarkerService extends markergmaps_ElementService
{
	/**
	 * @var markergmaps_GmarkerService
	 */
	private static $instance;

	/**
	 * @return markergmaps_GmarkerService
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
	 * @return markergmaps_persistentdocument_gmarker
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/gmarker');
	}

	/**
	 * Create a query based on 'modules_markergmaps/gmarker' model.
	 * Return document that are instance of modules_markergmaps/gmarker,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/gmarker');
	}
	
	/**
	 * Create a query based on 'modules_markergmaps/gmarker' model.
	 * Only documents that are strictly instance of modules_markergmaps/gmarker
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/gmarker', false);
	}
}