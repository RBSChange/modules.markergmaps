<?php
/**
 * markergmaps_persistentdocument_position
 * @package markergmaps
 */
class markergmaps_persistentdocument_position extends markergmaps_persistentdocument_positionbase
{
	/**
	 * @return String
	 */
	public function getFullDescription()
	{
		return GmapsHelper::getCleanAddress($this->getAddress() . "\n" . $this->getDescriptionAsHtml());
	}
	
	/**
	 * @return Array
	 */
	public function getGooglemapsvalue()
	{
		$value = array();
		$value['lat'] = $this->getLatitude();
		$value['lng'] = $this->getLongitude();
		$value['zoom'] = $this->getZoom();
		$value['maptype'] = $this->getMaptype();
		$value['colormarker'] = $this->getColormarker();
		$value['address'] = $this->getAddress();
		return JsonService::getInstance()->encode($value);
	}
	
	/**
	 * @param Array $value
	 */
	public function setGooglemapsvalue($value)
	{
		$parsedValue = JsonService::getInstance()->decode($value);
		if (isset($parsedValue['lat']))
		{
			$this->setLatitude($parsedValue['lat']);
		}
		if (isset($parsedValue['lng']))
		{
			$this->setLongitude($parsedValue['lng']);
		}
		if (isset($parsedValue['zoom']))
		{
			$this->setZoom($parsedValue['zoom']);
		}
		if (isset($parsedValue['maptype']))
		{
			$this->setMaptype($parsedValue['maptype']);
		}
		if (isset($parsedValue['colormarker']))
		{
			$this->setColormarker($parsedValue['colormarker']);
		}
		if (isset($parsedValue['address']))
		{
			$this->setAddress($parsedValue['address']);
		}
	}
}