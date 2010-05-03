<?php
/**
 * markergmaps_GmarkerScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_GmarkerScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_gmarker
     */
    protected function initPersistentDocument()
    {
    	return markergmaps_GmarkerService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_markergmaps/gmarker');
	}
}