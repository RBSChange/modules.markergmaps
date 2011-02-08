<?php
/**
 * Class where to put your custom methods for document markergmaps_persistentdocument_element
 * @package modules.markergmaps.persistentdocument
 */
class markergmaps_persistentdocument_element extends markergmaps_persistentdocument_elementbase
{
	public function getFrontofficeCode($mapName)
	{
		throw new Exception("Method getFrontofficeCode() should be implemented in " . get_class($this) . " class");
	}
}