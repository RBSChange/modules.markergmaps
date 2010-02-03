<?php
class markergmaps_GmapsCoordinates
{
	private $jsonObject;

	public function __construct($obj)
	{
		$this->jsonObject = $obj;
	}

	/**
	 * @return Float
	 */
	public function getLongitude()
	{
		if($this->hasCoordinates())
		{
			return $this->jsonObject["Placemark"][0]["Point"]["coordinates"][0];
		}
		return null;
	}

	/**
	 * @return Float
	 */
	public function getLatitude()
	{
		if($this->hasCoordinates())
		{
			return $this->jsonObject["Placemark"][0]["Point"]["coordinates"][1];
		}
		return null;
	}

	/**
	 * @return Boolean
	 */
	public function hasCoordinates()
	{
		return isset($this->jsonObject["Placemark"][0]);
	}
}