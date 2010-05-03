<?php
/**
 * Class where to put your custom methods for document markergmaps_persistentdocument_map
 * @package modules.markergmaps.persistentdocument
 */
class markergmaps_persistentdocument_map extends markergmaps_persistentdocument_mapbase
{
	public function getGmapselements()
	{
		$info = array();
		foreach ($this->getElementsArray() as $element)
		{
			$info[] = array(
				'id'=>$element->getId(),
				'type'=>f_Locale::translateUI('&modules.markergmaps.document.'.$element->getDocumentModel()->getDocumentName().'.Document-name;'),
				'label'=>$element->getLabel(),
				'model'=>str_replace('/', '_', $element->getDocumentModelName()),
				'status'=>f_Locale::translateUI(DocumentHelper::getPublicationstatusLocaleKey($element))
			);
		}
		return $info;
	}

	/**
	 * @return string
	 */
	public function getElementsJSON()
	{
		return JsonService::getInstance()->encode($this->getGmapselements());
	}

	public function getInitmap()
	{
		$info = array();
		$info['latitude'] = $this->getLatitude();
		$info['longitude'] = $this->getLongitude();
		$info['zoom'] = $this->getZoom();
		$info['maptype'] = $this->getMaptype();
		$info['width'] = $this->getWidth();
		$info['height'] = $this->getHeight();
		return JsonService::getInstance()->encode($info);
	}

	public function setInitmap($value)
	{
		$value = JsonService::getInstance()->decode($value);
		$this->setLatitude($value['latitude']);
		$this->setLongitude($value['longitude']);
		$this->setZoom($value['zoom']);
		$this->setMaptype($value['maptype']);
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