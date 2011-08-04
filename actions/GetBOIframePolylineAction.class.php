<?php
/**
 * @date Mon, 08 Sep 2008 08:51:19 +0000
 * @package modules.markergmaps
 */
class markergmaps_GetBOIframePolylineAction extends change_Action
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
		$request->setParameter('color', $request->getParameter('color', 'ff0000'));
		$request->setParameter('points', $request->getParameter('points', ''));
		$request->setParameter('weight', $request->getParameter('weight', 5));
		$request->setParameter('opacity', $request->getParameter('opacity', 0.5));
		if($request->hasParameter('id'))
		{
			$element = DocumentHelper::getDocumentInstance($request->getParameter('id'));
			$elements = markergmaps_ElementService::getInstance()->createQuery()->add(Restrictions::eq('mapid', $element->getMapid()))->add(Restrictions::ne('id', $element->getId()))->find();
			$request->setParameter('elements', $elements);
		}

		$js = website_JsService::getInstance()->registerScript('modules.website.lib.js.jquery')->executeInline(K::HTML);
		$request->setParameter('js', $js);

		return change_View::SUCCESS ;
	}
}