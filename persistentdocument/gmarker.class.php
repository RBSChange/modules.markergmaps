<?php
/**
 * Class where to put your custom methods for document markergmaps_persistentdocument_gmarker
 * @package modules.markergmaps.persistentdocument
 */
class markergmaps_persistentdocument_gmarker extends markergmaps_persistentdocument_gmarkerbase
{
	public function setGooglemapsvalue($value)
	{
		$value = JsonService::getInstance()->decode($value);
		$this->setLatitude($value['latitude']);
		$this->setLongitude($value['longitude']);
	}

	public function getGooglemapsvalue()
	{
		$info = array();
		$info['mapElementId'] = $this->getId();
		$info['latitude'] = $this->getLatitude();
		$info['longitude'] = $this->getLongitude();
		$info['colormarker'] = $this->getColormarker();
		if($this->getPictoId())
		{
			$info['picto'] = $this->getPictoUrl();
			$info['width'] = $this->getWidth();
			$info['height'] = $this->getHeight();
		}
		if($this->getShadowId())
		{
			$info['shadow'] = $this->getShadowUrl();
			$info['swidth'] = $this->getSwidth();
			$info['sheight'] = $this->getSheight();
		}
		return JsonService::getInstance()->encode($info);
	}

	public function getPictoUrl()
	{
		if($this->getPictoId())
		{
			return MediaHelper::getPublicResizedUrl($this->getPicto(), $this->getWidth(), $this->getHeight());
		}
		return "";
	}

	public function getShadowUrl()
	{
		if($this->getShadowId())
		{
			return MediaHelper::getPublicResizedUrl($this->getShadow(), $this->getSwidth(), $this->getSheight());
		}
		return "";
	}

	public function getFrontofficeCode($mapName, $overlayName)
	{
		if($this->isDefined())
		{
			$tpl = TemplateLoader::getInstance()->setPackageName('modules_markergmaps')->setDirectory('templates/includes')->setMimeContentType('html')->load('Gmarker');
			$tpl->setAttribute('gmarker', $this);
			$tpl->setAttribute('map', $mapName);
			$tpl->setAttribute('o', $overlayName);
			$tpl->setOriginalPath(null);
			return $tpl->execute();
		}
		return null;
	}

	public function isDefined()
	{
		if($this->getLatitude() && $this->getLongitude())
		{
			return true;
		}
		return false;
	}

	public function getAddslashesSummaryAsHtml()
	{
		return str_replace("\n", "", addslashes($this->getSummaryAsHtml()));
	}

	public function getAddslashesTitleAsHtml()
	{
		return str_replace("\n", "", addslashes($this->getTitleAsHtml()));
	}

	public function getAddslashesDescriptionAsHtml()
	{
		return str_replace("\n", "", addslashes($this->getDescriptionAsHtml()));
	}

}