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
			self::$instance = self::getServiceClassInstance(get_class());
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

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param Integer $parentNodeId Parent node ID where to save the document (optionnal => can be null !).
	 * @return void
	 */
//	protected function preSave($document, $parentNodeId = null)
//	{
//
//	}


	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function preInsert($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function postInsert($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function preUpdate($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function postUpdate($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param Integer $parentNodeId Parent node ID where to save the document.
	 * @return void
	 */
//	protected function postSave($document, $parentNodeId = null)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @return void
	 */
//	protected function preDelete($document)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @return void
	 */
//	protected function preDeleteLocalized($document)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @return void
	 */
//	protected function postDelete($document)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @return void
	 */
//	protected function postDeleteLocalized($document)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @return boolean true if the document is publishable, false if it is not.
	 */
//	public function isPublishable($document)
//	{
//		$result = parent::isPublishable($document);
//		return $result;
//	}


	/**
	 * Methode à surcharger pour effectuer des post traitement apres le changement de status du document
	 * utiliser $document->getPublicationstatus() pour retrouver le nouveau status du document.
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param String $oldPublicationStatus
	 * @param array<"cause" => String, "modifiedPropertyNames" => array, "oldPropertyValues" => array> $params
	 * @return void
	 */
//	protected function publicationStatusChanged($document, $oldPublicationStatus, $params)
//	{
//	}

	/**
	 * Correction document is available via $args['correction'].
	 * @param f_persistentdocument_PersistentDocument $document
	 * @param Array<String=>mixed> $args
	 */
//	protected function onCorrectionActivated($document, $args)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param String $tag
	 * @return void
	 */
//	public function tagAdded($document, $tag)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param String $tag
	 * @return void
	 */
//	public function tagRemoved($document, $tag)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $fromDocument
	 * @param f_persistentdocument_PersistentDocument $toDocument
	 * @param String $tag
	 * @return void
	 */
//	public function tagMovedFrom($fromDocument, $toDocument, $tag)
//	{
//	}

	/**
	 * @param f_persistentdocument_PersistentDocument $fromDocument
	 * @param markergmaps_persistentdocument_polyline $toDocument
	 * @param String $tag
	 * @return void
	 */
//	public function tagMovedTo($fromDocument, $toDocument, $tag)
//	{
//	}

	/**
	 * Called before the moveToOperation starts. The method is executed INSIDE a
	 * transaction.
	 *
	 * @param f_persistentdocument_PersistentDocument $document
	 * @param Integer $destId
	 */
//	protected function onMoveToStart($document, $destId)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param Integer $destId
	 * @return void
	 */
//	protected function onDocumentMoved($document, $destId)
//	{
//	}

	/**
	 * this method is call before save the duplicate document.
	 * If this method not override in the document service, the document isn't duplicable.
	 * An IllegalOperationException is so launched.
	 *
	 * @param f_persistentdocument_PersistentDocument $newDocument
	 * @param f_persistentdocument_PersistentDocument $originalDocument
	 * @param Integer $parentNodeId
	 *
	 * @throws IllegalOperationException
	 */
//	protected function preDuplicate($newDocument, $originalDocument, $parentNodeId)
//	{
//		throw new IllegalOperationException('This document cannot be duplicated.');
//	}

	/**
	 * Returns the URL of the document if has no URL Rewriting rule.
	 *
	 * @param markergmaps_persistentdocument_polyline $document
	 * @param string $lang
	 * @param array $parameters
	 * @return string
	 */
//	public function generateUrl($document, $lang, $parameters)
//	{
//	}

	/**
	 * @param markergmaps_persistentdocument_polyline $document
	 * @return integer | null
	 */
//	public function getWebsiteId($document)
//	{
//	}

	/**
	 * @param f_persistentdocument_PersistentDocument $document
	 * @return website_persistentdocument_page | null
	 */
//	public function getDisplayPage($document)
//	{
//	}
}