<?php
/**
 * @date Mon, 08 Sep 2008 08:51:19 +0000
 * @package modules.GetBOIframe
 */
class markergmaps_GetBOIframePreviewSuccessView extends f_view_BaseView
{
	/**
	 * @param Context $context
	 * @param Request $request
	 */
	public function _execute($context, $request)
	{
		$this->setTemplateName('Markergmaps-Preview');

		$this->setAttributes($request->getParameters());
	}
}