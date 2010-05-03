<?php
/**
 * Class where to put your custom methods for document markergmaps_persistentdocument_polygon
 * @package modules.markergmaps.persistentdocument
 */
class markergmaps_persistentdocument_polygon extends markergmaps_persistentdocument_polygonbase
{
	public function setGooglemapsvalue($value)
	{
		$value = JsonService::getInstance()->decode($value);
		$this->setPoints($value['points']);
	}

	public function getGooglemapsvalue()
	{
		$info = array();
		$info['points'] = $this->getPoints();
		$info['color'] = substr($this->getColor(), 1);
		$info['fillcolor'] = substr($this->getFillcolor(), 1);
		$info['weight'] = $this->getWeight();
		$info['opacity'] = $this->getOpacity();
		$info['fillopacity'] = $this->getFillopacity();
		return JsonService::getInstance()->encode($info);
	}

	public function getFrontofficeCode($mapName, $overlayName)
	{
		$tpl = TemplateLoader::getInstance()->setPackageName('modules_markergmaps')->setDirectory('templates/includes')->setMimeContentType(K::HTML)->load('Polygon');
		$tpl->setAttribute('polygon', $this);
		$tpl->setAttribute('map', $mapName);
		$tpl->setAttribute('o', $overlayName);
		$tpl->setOriginalPath(null);
		return $tpl->execute();
	}

	/**
	 * @param string $moduleName
	 * @param string $treeType
	 * @param array<string, string> $nodeAttributes
	 */
//	protected function addTreeAttributes($moduleName, $treeType, &$nodeAttributes)
//	{
//	}

	/**
	 * @param string $actionType
	 * @param array $formProperties
	 */
//	public function addFormProperties($propertiesNames, &$formProperties)
//	{
//	}
}