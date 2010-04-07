<?php

class markergmaps_BlockFolderAction extends website_BlockAction
{
	
	/**
	 * @see website_BlockAction::execute()
	 *
	 * @param f_mvc_Request $request
	 * @param f_mvc_Response $response
	 * @return String
	 */
	function execute($request, $response)
	{
		if ($this->isInBackoffice())
		{
			$this->setDatas($request, true);
			return website_BlockView::DUMMY;
		}
		$this->setDatas($request);
		$request->setAttribute("gpsexport", $this->getConfiguration()->getGpsexport());
		$request->setAttribute("showpositionslist",  $this->getConfiguration()->getShowpositionslist());
		return website_BlockView::SUCCESS;
	}
	
	private function setDatas($request, $bo = false)
	{
		$pref = ModuleService::getInstance()->getPreferencesDocument('markergmaps');
		$width = $height = $maxwidth = $maxheight = null;
		if ($pref !== null)
		{
			$prefwidth = $pref->getWidth();
			$prefheight = $pref->getHeight();
			$prefmaxheight = $pref->getMaxHeight();
			$prefmaxwidth = $pref->getMaxWidth();
		}
		$width = $this->getConfigurationParameter('width', $prefwidth);
		$height = $this->getConfigurationParameter('height', $prefheight);
		$maxwidth = $this->getConfigurationParameter('maxwidth', $prefmaxwidth);
		$maxheight = $this->getConfigurationParameter('maxheight', $prefmaxheight);
		$folder = $this->getDocumentParameter();
		if ($bo)
		{
			$request->setAttribute('title', $folder->getLabel());
			$style['width'] = $width . "px";
			$style['height'] = $height . "px";
			$style['border'] = '1px dotted grey';
			$request->setAttribute('style', f_util_HtmlUtils::buildStyleAttribute($style));
		}
		else
		{
			$positions = markergmaps_PositionService::getInstance()->getByFolderId($folder->getId(), $this->getConfigurationParameter('subfolder', false));
			$request->setAttribute('positions', $positions);
			$request->setAttribute('folder', $folder);
			$request->setAttribute('width', $width);
			$request->setAttribute('height', $height);
			$request->setAttribute('maxwidth', $maxwidth);
			$request->setAttribute('maxheight', $maxheight);
		}
	}
}