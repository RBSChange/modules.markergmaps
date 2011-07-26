<?php
/**
 * Class where to put your custom methods for document markergmaps_persistentdocument_map
 * @package modules.markergmaps.persistentdocument
 */
class markergmaps_persistentdocument_map extends markergmaps_persistentdocument_mapbase
{
	/**
	 * @return array
	 */
	public function getGmapselements()
	{
		$ls = LocaleService::getInstance();
		$info = array();
		foreach ($this->getElementsArray() as $element)
		{
			/* @var $element markergmaps_persistentdocument_element */
			$info[] = array(
				'id' => $element->getId(),
				'type' => $ls->transBO('m.markergmaps.document.'.$element->getPersistentModel()->getDocumentName().'.document-name', array('ucf')),
				'label'=> $element->getLabel(),
				'model' => str_replace('/', '_', $element->getDocumentModelName()),
				'status' => $ls->transBO(DocumentHelper::getStatusLocaleKey($element))
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
}