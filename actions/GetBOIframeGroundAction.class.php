<?php
/**
 * @date Mon, 08 Sep 2008 08:51:19 +0000
 * @package modules.markergmaps
 */
class markergmaps_GetBOIframeGroundAction extends change_Action
{
	/**
	 * @param change_Context $context
	 * @param change_Request $request
	 */
	public function _execute($context, $request)
	{
		$url = GmapsHelper::getGmapsUrlForDefaultWebsite();

		if($url === null)
		{
			return change_View::NONE ;
		}

		$request->setParameter('url', $url);
		$request->setParameter('country', f_Locale::translate('&modules.markergmaps.bo.country.'.RequestContext::getInstance()->getLang().';'));
		$request->setParameter('swlat', $request->getParameter('swlat'));
		$request->setParameter('swlng', $request->getParameter('swlng'));
		$request->setParameter('nelat', $request->getParameter('nelat'));
		$request->setParameter('nelng', $request->getParameter('nelng'));
		if($request->hasParameter('id'))
		{
			$element = DocumentHelper::getDocumentInstance($request->getParameter('id'));
			$elements = markergmaps_ElementService::getInstance()->createQuery()->add(Restrictions::eq('mapid', $element->getMapid()))->add(Restrictions::ne('id', $element->getId()))->find();
			$request->setParameter('elements', $elements);
		}

		$js = website_JsService::getInstance()->registerScript('modules.website.lib.js.jquery')->executeInline('html');
		$request->setParameter('js', $js);

		return change_View::SUCCESS ;
	}
}