<?php
/**
 * markergmaps_PolylineScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_PolylineScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_polyline
     */
    protected function initPersistentDocument()
    {
    	return markergmaps_PolylineService::getInstance()->getNewDocumentInstance();
    }
    
    /**
	 * @return f_persistentdocument_PersistentDocumentModel
	 */
	protected function getDocumentModel()
	{
		return f_persistentdocument_PersistentDocumentModel::getInstanceFromDocumentModelName('modules_markergmaps/polyline');
	}
}