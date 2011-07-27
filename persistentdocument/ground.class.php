<?php
/**
 * Class where to put your custom methods for document markergmaps_persistentdocument_ground
 * @package modules.markergmaps.persistentdocument
 */
class markergmaps_persistentdocument_ground extends markergmaps_persistentdocument_groundbase
{
	public function setGooglemapsvalue($value)
	{
		$value = JsonService::getInstance()->decode($value);
		$this->setSwlat($value['swlat']);
		$this->setSwlng($value['swlng']);
		$this->setNelat($value['nelat']);
		$this->setNelng($value['nelng']);
	}

	public function getGooglemapsvalue()
	{
		$info = array();
		$info['mapElementId'] = $this->getId();
		$info['swlat'] = $this->getSwlat();
		$info['swlng'] = $this->getSwlng();
		$info['nelat'] = $this->getNelat();
		$info['nelng'] = $this->getNelng();
		if($this->getImageId())
		{
			$info['image'] = $this->getImageUrl();
		}
		return JsonService::getInstance()->encode($info);
	}

	public function getFrontofficeCode($mapName, $overlayName)
	{
		if($this->isDefined())
		{
			$tpl = TemplateLoader::getInstance()->setPackageName('modules_markergmaps')->setDirectory('templates/includes')->setMimeContentType(K::HTML)->load('Ground');
			$tpl->setAttribute('ground', $this);
			$tpl->setAttribute('map', $mapName);
			$tpl->setAttribute('o', $overlayName);
			$tpl->setOriginalPath(null);
			return $tpl->execute();
		}
		return null;
	}

	public function isDefined()
	{
		if($this->getSwlat() && $this->getSwlng() && $this->getNelat() && $this->getNelng())
		{
			return true;
		}
		return false;
	}

	public function getImageUrl()
	{
		return LinkHelper::getDocumentUrl($this->getImage());
	}
}