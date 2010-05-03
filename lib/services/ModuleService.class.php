<?php
/**
 * @package modules.markergmaps.lib.services
 */
class markergmaps_ModuleService extends ModuleBaseService
{
	/**
	 * Singleton
	 * @var markergmaps_ModuleService
	 */
	private static $instance = null;

	/**
	 * @return markergmaps_ModuleService
	 */
	public static function getInstance()
	{
		if (is_null(self::$instance))
		{
			self::$instance = self::getServiceClassInstance(get_class());
		}
		return self::$instance;
	}

	/**
	 * @param Integer $documentId
	 * @return f_persistentdocument_PersistentTreeNode
	 */
	public function getParentNodeForPermissions($documentId)
	{
		$document = DocumentHelper::getDocumentInstance($documentId);
		if ($document instanceof markergmaps_persistentdocument_element)
		{
			return TreeService::getInstance()->getInstanceByDocumentId($document->getMapid());
		}
		return null;
	}
}