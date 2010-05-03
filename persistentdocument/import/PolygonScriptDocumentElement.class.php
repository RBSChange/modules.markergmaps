<?php
/**
 * markergmaps_PolygonScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_PolygonScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_polygon
     */
    protected function initPersistentDocument()
    {
    	return markergmaps_PolygonService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_markergmaps/polygon');
	}
}