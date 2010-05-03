<?php
/**
 * markergmaps_MapScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_MapScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_map
     */
    protected function initPersistentDocument()
    {
    	return markergmaps_MapService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_markergmaps/map');
	}
}