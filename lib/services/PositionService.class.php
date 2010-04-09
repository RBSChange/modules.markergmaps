<?php
/**
 * @date Mon, 08 Sep 2008 06:52:09 +0000
 * @author intessit
 * @package
 */
class markergmaps_PositionService extends f_persistentdocument_DocumentService
{
	/**
	 * @var markergmaps_PositionService
	 */
	private static $instance;
	
	/**
	 * @return markergmaps_PositionService
	 */
	public static function getInstance()
	{
		if (self::$instance === null)
		{
			self::$instance = self::getServiceClassInstance(get_class());
		}
		return self::$instance;
	}
	
	/**
	 * @return markergmaps_persistentdocument_position
	 */
	public function getNewDocumentInstance()
	{
		return $this->getNewDocumentInstanceByModelName('modules_markergmaps/position');
	}
	
	/**
	 * Create a query based on 'modules_markergmaps/position' model
	 * @return f_persistentdocument_criteria_Query
	 */
	public function createQuery()
	{
		return $this->pp->createQuery('modules_markergmaps/position');
	}
	
	/**
	 * @param markergmaps_persistentdocument_position $document
	 * @param Integer $parentNodeId Parent node ID where to save the document (optionnal => can be null !).
	 * @return void
	 */
	protected function preSave($document, $parentNodeId = null)
	{
		if ($document->getColormarker() === null)
		{
			$document->setColormarker(GmapsHelper::getDefaultIconColor());
		}
		if ($document->getZoom() === null)
		{
			$document->setZoom(GmapsHelper::getDefaultZoomLevel());
		}
	}
	
	/**
	 * @param generic_persistentdocument_folder $folder
	 */
	public function getOv2ContentForFolder($folder)
	{
		$positions = $this->createQuery()->add(Restrictions::descendentOf($folder->getId()))->add(Restrictions::published())->find();
		return $this->getOv2ContentForPositions($positions);
	}
	
	/**
	 * @param markergmaps_persistentdocument_position[] $positions
	 */
	public function getOv2ContentForPositions($positions)
	{
		$content = "";
		foreach ($positions as $position)
		{
			$label = $position->getLabel();
			$content .= pack('C', 0x02) . pack('V', mb_strlen($label) + 14) . pack('V', (int)round($position->getLongitude() * 100000.0)) . pack('V', (int)round($position->getLatitude() * 100000.0)) . $label . chr(0x00);
		}
		return $content;
	}
	
	/**
	 * @param generic_persistentdocument_folder $folder
	 */
	public function getGpxContentForFolder($folder)
	{
		$positions = $this->createQuery()->add(Restrictions::descendentOf($folder->getId()))->add(Restrictions::published())->find();
		return $this->getGpxContentForPositions($positions);
	}
	
	/**
	 * @param markergmaps_persistentdocument_position[] $positions
	 */
	public function getGpxContentForPositions($positions)
	{
		$xmlWriter = new XMLWriter();
		$xmlWriter->openMemory();
		$xmlWriter->startDocument("1.0", "UTF-8");
		if (Framework::isDebugEnabled())
		{
			$xmlWriter->setIndent(true);
		}
		$xmlWriter->startElement("gpx");
		$xmlWriter->writeAttribute('xmlns', "http://www.topografix.com/GPX/1/1");
		$xmlWriter->writeAttribute('xmlns:xsi', "http://www.w3.org/2001/XMLSchema-instance");
		$xmlWriter->writeAttribute('xsi:schemaLocation', "http://www.topografix.com/GPX/1/1 http://www.topografix.com/GPX/1/1/gpx.xsd");
		$xmlWriter->writeAttribute("version", "1.1");
		$xmlWriter->writeAttribute("creator", "RBS Change");
		foreach ($positions as $position)
		{
			$xmlWriter->startElement("wpt");
			$xmlWriter->writeAttribute('lon', strval($position->getLongitude()));
			$xmlWriter->writeAttribute('lat', strval($position->getLatitude()));
			$xmlWriter->writeElement("name", $position->getLabel());
			$xmlWriter->endElement();
		}
		$xmlWriter->endElement();
		return $xmlWriter->flush();
	}
	

	/**
	 * @see f_persistentdocument_DocumentService::getResume()
	 *
	 * @param markergmaps_persistentdocument_position $document
	 * @param string $forModuleName
	 * @param array $allowedSections
	 * @return array
	 */
	public function getResume($document, $forModuleName, $allowedSections = null)
	{
		$data = parent::getResume($document, $forModuleName, $allowedSections);
		$data['properties']['latitude'] = $document->getLatitude();
		$data['properties']['longitude'] = $document->getLongitude();
		return $data;
	}

	/**
	 * @param String $folderId
	 * @param Boolean $subFolder
	 * @return markergmaps_persistentdocument_position[]
	 */
	public function getByFolderId($folderId, $subFolder = false)
	{
		if ($subFolder)
		{
			return $this->createQuery()->add(Restrictions::published())->add(Restrictions::descendentOf($folderId))->find();
		}
		return $this->createQuery()->add(Restrictions::published())->add(Restrictions::published())->add(Restrictions::childOf($folderId))->find();
	}
}