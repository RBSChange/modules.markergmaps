<?php
/**
 * markergmaps_GroundService
 * @package modules.markergmaps
 */
class markergmaps_GroundService extends markergmaps_ElementService
{
	/**
	 * @var markergmaps_GroundService
	 */
	private static $instance;

	/**
	 * @return markergmaps_GroundService
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
	 * @return markergmaps_persistentdocument_ground
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/ground');
	}

	/**
	 * Create a query based on 'modules_markergmaps/ground' model.
	 * Return document that are instance of modules_markergmaps/ground,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/ground');
	}
	
	/**
	 * Create a query based on 'modules_markergmaps/ground' model.
	 * Only documents that are strictly instance of modules_markergmaps/ground
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/ground', false);
	}
}