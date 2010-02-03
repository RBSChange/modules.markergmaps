<?php
/**
 * markergmaps_PositionScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_PositionScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_position
     */
    protected function initPersistentDocument()
    {
    	return markergmaps_PositionService::getInstance()->getNewDocumentInstance();
    }
}