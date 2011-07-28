<?php
class GmapsHelper
{
	/**
	 * @param website_persistentdocument_website $website
	 * @return String
	 */
	public static function getKeyForWebsite($website)
	{
		$lang = RequestContext::getInstance()->getLang();
		$markers = website_MarkerService::getInstance()->getByWebsiteAndLang($website, $lang);
		$key = null;
		foreach ($markers as $marker)
		{
			if($marker instanceof markergmaps_persistentdocument_markergmaps)
			{
				$key = $marker->getAccount();
			}
		}
		return $key;
	}

	/**
	 * @return String
	 */
	public static function getKeyForCurrentWebsite()
	{
		return GmapsHelper::getKeyForWebsite(website_WebsiteModuleService::getInstance()->getCurrentWebsite());
	}
	/**
	 * @return String
	 */
	public static function getKeyForDefaultWebsite()
	{
		return GmapsHelper::getKeyForWebsite(website_WebsiteModuleService::getInstance()->getDefaultWebsite());
	}

	/**
	 * @return String
	 */
	public static function getGmapsUrlForCurrentWebsite()
	{
		return GmapsHelper::getGoogleMapsUrl()."?file=api&v=2.223&hl=".RequestContext::getInstance()->getLang()."&key=".GmapsHelper::getKeyForCurrentWebsite();
	}

	/**
	 * @return String
	 */
	public static function getGmapsUrlForDefaultWebsite()
	{
		return GmapsHelper::getGoogleMapsUrl()."?file=api&v=2.223&hl=".RequestContext::getInstance()->getLang()."&key=".GmapsHelper::getKeyForDefaultWebsite();
	}

	/**
	 * @param String $address
	 * @return markergmaps_GmapsCoordinates
	 */
	public static function getCoordinates($address)
	{
		$url = GmapsHelper::getGoogleMapsUrl()."/geo?output=json&q=".urlencode($address)."&key=".GmapsHelper::getKeyForCurrentWebsite();
		$json = f_util_StringUtils::JSONDecode(file_get_contents($url));
		return new markergmaps_GmapsCoordinates($json);
	}

	public static function getCleanAddress($address)
	{
		return addslashes(str_replace(array("\r\n", "\n"), "<br/>", $address));
	}

	/**
	 * Return google maps base url
	 *
	 * @return String
	 */
	public static function getGoogleMapsUrl()
	{
		return 'http://maps.google.fr/maps';
	}

	/**
	 * Return google icon maps base url
	 *
	 * @return String
	 */
	public static function getGoogleIconsUrl()
	{
		return 'http://www.google.com/mapfiles/ms/micons/';
	}

	/**
	 * Return default icon color used on maps to mark a position
	 *
	 * @return String
	 */
	public static function getDefaultIconColor()
	{
		return 'red-dot.png';
	}

	public static function getDefaultZoomLevel()
	{
		return 4;
	}
}