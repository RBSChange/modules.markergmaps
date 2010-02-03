<?php
/**
 * @date Wed, 17 Dec 2008 12:47:54 +0000
 * @author intstaufl
 * @package modules.markergmaps
 */
class markergmaps_ExportGpsOv2Action extends f_action_BaseAction
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$documentId = $request->getModuleParameter('markergmaps', K::COMPONENT_ID_ACCESSOR);
		if (is_int($documentId) && $documentId > 0)
		{
			$document = DocumentHelper::getDocumentInstance(intval($documentId));
		}
		else 
		{
			$document = $this->getDocumentInstanceFromRequest($request);
		}
		
		$headers = array();
		
		$headers[] = 'Cache-Control: public, must-revalidate';
		$headers[] = 'Pragma: hack';
		$headers[] = 'Content-type: application/octet-stream';
		$headers[] = 'Content-Disposition: attachment; filename="poi_' . $document->getId() . '.ov2"';
		$headers[] = 'Content-Transfer-Encoding: binary';
		
		foreach ($headers as $header)
		{
			header($header);
		}
		
		if ($document instanceof generic_persistentdocument_folder)
		{
			echo markergmaps_PositionService::getInstance()->getOv2ContentForFolder($document);
		}
		else
		{
			echo markergmaps_PositionService::getInstance()->getOv2ContentForPositions(array($document));
		}
		
		return View::NONE;
	}
	
	/**
	 * @see f_action_BaseAction::isSecure()
	 *
	 * @return boolean
	 */
	public function isSecure()
	{
		return false;
	}
}