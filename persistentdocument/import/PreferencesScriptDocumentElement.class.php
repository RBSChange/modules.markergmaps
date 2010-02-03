<?php
/**
 * markergmaps_PreferencesScriptDocumentElement
 * @package modules.markergmaps.persistentdocument.import
 */
class markergmaps_PreferencesScriptDocumentElement extends import_ScriptDocumentElement
{
    /**
     * @return markergmaps_persistentdocument_preferences
     */
    protected function initPersistentDocument()
    {
    	$document = ModuleService::getInstance()->getPreferencesDocument('markergmaps');
    	return ($document !== null) ? $document : markergmaps_PreferencesService::getInstance()->getNewDocumentInstance();
    }
}