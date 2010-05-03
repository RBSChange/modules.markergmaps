<?php
/**
 * markergmaps_ElementScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_ElementScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_element
     */
    protected function initPersistentDocument()
    {
    	return markergmaps_ElementService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_markergmaps/element');
	}
}