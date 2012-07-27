<?php
/**
 * markergmaps_MapService
 * @package modules.markergmaps
 */
class markergmaps_MapService extends f_persistentdocument_DocumentService
{
	/**
	 * @var markergmaps_MapService
	 */
	private static $instance;

	/**
	 * @return markergmaps_MapService
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
	 * @return markergmaps_persistentdocument_map
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/map');
	}

	/**
	 * Create a query based on 'modules_markergmaps/map' model.
	 * Return document that are instance of modules_markergmaps/map,
	 * including potential children.
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/map');
	}

	/**
	 * Create a query based on 'modules_markergmaps/map' model.
	 * Only documents that are strictly instance of modules_markergmaps/map
	 * (not children) will be retrieved
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createStrictQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/map', false);
	}

	/**
	 * @param f_persistentdocument_PersistentDocument $document
	 * @param string $forModuleName
	 * @param array $allowedSections
	 * @return array
	 */
	public function getResume($document, $forModuleName, $allowedSections = null)
	{
		$data = parent::getResume($document, $forModuleName, $allowedSections);
		$iframeUrl = LinkHelper::getUIActionLink('markergmaps', 'GetBOIframePreview');
		$iframeUrl->setQueryParameter('id', $document->getId());
		$data['content']['iframeurl'] = $iframeUrl->getUrl();
		return $data;
	}
}