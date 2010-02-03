<?php
/**
 * markergmaps_persistentdocument_markergmaps
 * @package markergmaps
 */
class markergmaps_persistentdocument_markergmaps extends markergmaps_persistentdocument_markergmapsbase
{
	/**
	 * @return Array<String, mixed>
	 */
	public function getSpecificProperties()
	{
		return array('signupUrl' => 'http://code.google.com/apis/maps/signup.html');
	}
	
	/**
	 * param Array<String, mixed> $value
	 */
	public function setSpecificProperties($value)
	{
		// No specific properties to save.
	}
}