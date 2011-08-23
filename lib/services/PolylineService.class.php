<?php
/**
 * markergmaps_PolylineService
 * @package modules.markergmaps
 */
class markergmaps_PolylineService extends markergmaps_ElementService
{
	/**
	 * @var markergmaps_PolylineService
	 */
	private static $instance;

	/**
	 * @return markergmaps_PolylineService
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
	 * @return markergmaps_persistentdocument_polyline
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/polyline');
	}

	/**
	 * Create a query based on 'modules_markergmaps/polyline' model.
	 * Return document that are instance of modules_markergmaps/polyline,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/polyline');
	}

	/**
	 * Create a query based on 'modules_markergmaps/polyline' model.
	 * Only documents that are strictly instance of modules_markergmaps/polyline
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/polyline', false);
	}
}