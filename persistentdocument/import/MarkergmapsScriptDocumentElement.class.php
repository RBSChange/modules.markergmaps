<?php
/**
 * markergmaps_MarkergmapsScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_MarkergmapsScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_markergmaps
     */
    protected function initPersistentDocument()
    {
    	return markergmaps_MarkergmapsService::getInstance()->getNewDocumentInstance();
    }
}