<?php

class markergmaps_BlockMapAction extends website_BlockAction
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
			return website_BlockView::NONE;
		}

		$map = $this->getDocumentParameter();

		if(!$map instanceof markergmaps_persistentdocument_map || !$map->isPublished())
		{
			return website_BlockView::NONE;
		}

		if($map->getSearch())
		{
			$this->getPage()->addLink('stylesheet', 'text/css', 'http://www.google.com/uds/css/gsearch.css');
			$this->getPage()->addLink('stylesheet', 'text/css', 'http://www.google.com/uds/solutions/localsearch/gmlocalsearch.css');
		}

		if($map->getStreetview())
		{
			$request->setAttribute('icon', MediaHelper::getStaticUrl('front/gmaps-man.png'));
			$request->setAttribute('flyicon', MediaHelper::getStaticUrl('front/gmaps-flyman.png'));
			$request->setAttribute('dragicon', MediaHelper::getStaticUrl('front/gmaps-drag.gif'));
			$request->setAttribute('closeicon', MediaHelper::getStaticUrl('front/gmaps-close.png'));
			$request->setAttribute('backtomap', f_Locale::translate("&modules.markergmaps.frontoffice.Backtomap;"));
		}

		if(!$this->getContext()->hasAttribute('gmapsloaded'))
		{
			$this->getContext()->setAttribute('gmapsloaded', true);
			$request->setAttribute('load', true);
		}

		if($map->getChoosedisplay())
		{
			$this->getPage()->addScript('modules.markergmaps.lib.js.overlays');
		}

		$request->setAttribute('map', $map);

		return website_BlockView::SUCCESS;
	}
}