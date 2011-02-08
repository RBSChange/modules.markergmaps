<?php
/**
 * Class where to put your custom methods for document markergmaps_persistentdocument_polyline
 * @package modules.markergmaps.persistentdocument
 */
class markergmaps_persistentdocument_polyline extends markergmaps_persistentdocument_polylinebase
{
	public function setGooglemapsvalue($value)
	{
		$value = JsonService::getInstance()->decode($value);
		$this->setPoints($value['points']);
	}

	public function getGooglemapsvalue()
	{
		$info = array();
		$info['mapElementId'] = $this->getId();
		$info['points'] = $this->getPoints();
		$info['color'] = substr($this->getColor(), 1);
		$info['weight'] = $this->getWeight();
		$info['opacity'] = $this->getOpacity();
		return JsonService::getInstance()->encode($info);
	}

	public function getFrontofficeCode($mapName, $overlayName)
	{
		if($this->isDefined())
		{
			$tpl = TemplateLoader::getInstance()->setPackageName('modules_markergmaps')->setDirectory('templates/includes')->setMimeContentType(K::HTML)->load('Polyline');
			$tpl->setAttribute('polyline', $this);
			$tpl->setAttribute('map', $mapName);
			$tpl->setAttribute('o', $overlayName);
			$tpl->setOriginalPath(null);
			return $tpl->execute();
		}
		return null;
	}

	public function isDefined()
	{
		if($this->getPoints())
		{
			return true;
		}
		return false;
	}

}