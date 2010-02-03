<?php
/**
 * markergmaps_persistentdocument_preferences
 * @package markergmaps
 */
class markergmaps_persistentdocument_preferences extends markergmaps_persistentdocument_preferencesbase 
{
	/**
	 * @return String
	 */
	public function getLabel()
	{
		return f_Locale::translateUI(parent::getLabel());
	}
}