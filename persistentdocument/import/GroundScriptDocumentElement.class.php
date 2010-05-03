<?php
/**
 * markergmaps_GroundScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_GroundScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_ground
     */
    protected function initPersistentDocument()
    {
    	return markergmaps_GroundService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_markergmaps/ground');
	}
}