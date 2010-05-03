<?php
/**
 * @date Mon, 08 Sep 2008 08:51:19 +0000
 * @package modules.markergmaps
 */
class markergmaps_GetBOIframePreviewAction extends f_action_BaseAction
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$url = GmapsHelper::getGmapsUrlForDefaultWebsite();

		if($url === null)
		{
			return View::NONE ;
		}

		$request->setParameter('url', $url);
		$request->setParameter('country', f_Locale::translate('&modules.markergmaps.bo.country.'.RequestContext::getInstance()->getLang().';'));
		try
		{
			$map = DocumentHelper::getDocumentInstance($request->getParameter('id'));
			$request->setParameter('map', $map);
			if($map->getStreetview())
			{
				$request->setParameter('icon', MediaHelper::getStaticUrl('front/gmaps-man.png'));
				$request->setParameter('flyicon', MediaHelper::getStaticUrl('front/gmaps-flyman.png'));
				$request->setParameter('dragicon', MediaHelper::getStaticUrl('front/gmaps-drag.gif'));
				$request->setParameter('closeicon', MediaHelper::getStaticUrl('front/gmaps-close.png'));
				$request->setParameter('backtomap', f_Locale::translate("&modules.markergmaps.frontoffice.Backtomap;"));
			}
		}
		catch (Exception $e)
		{
			return View::NONE ;
		}

		return View::SUCCESS ;
	}
}