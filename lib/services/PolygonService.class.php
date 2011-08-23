<?php
/**
 * markergmaps_PolygonService
 * @package modules.markergmaps
 */
class markergmaps_PolygonService extends markergmaps_ElementService
{
	/**
	 * @var markergmaps_PolygonService
	 */
	private static $instance;

	/**
	 * @return markergmaps_PolygonService
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
	 * @return markergmaps_persistentdocument_polygon
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/polygon');
	}

	/**
	 * Create a query based on 'modules_markergmaps/polygon' model.
	 * Return document that are instance of modules_markergmaps/polygon,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/polygon');
	}
	
	/**
	 * Create a query based on 'modules_markergmaps/polygon' model.
	 * Only documents that are strictly instance of modules_markergmaps/polygon
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/polygon', false);
	}
}