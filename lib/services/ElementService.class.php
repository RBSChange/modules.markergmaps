<?php
/**
 * markergmaps_ElementService
 * @package modules.markergmaps
 */
class markergmaps_ElementService extends f_persistentdocument_DocumentService
{
	/**
	 * @var markergmaps_ElementService
	 */
	private static $instance;

	/**
	 * @return markergmaps_ElementService
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
	 * @return markergmaps_persistentdocument_element
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/element');
	}

	/**
	 * Create a query based on 'modules_markergmaps/element' model.
	 * Return document that are instance of modules_markergmaps/element,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/element');
	}

	/**
	 * Create a query based on 'modules_markergmaps/element' model.
	 * Only documents that are strictly instance of modules_markergmaps/element
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/element', false);
	}

	/**
	 * @param markergmaps_persistentdocument_element $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
	protected function preInsert($document, $parentNodeId = null)
	{
		$document->setMapid($parentNodeId);
	}
}