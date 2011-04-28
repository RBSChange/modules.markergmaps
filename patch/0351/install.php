<?php
/**
 * markergmaps_patch_0351
 * @package modules.markergmaps
 */
class markergmaps_patch_0351 extends patch_BasePatch
{
	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		$this->execChangeCommand('compile-locales', array('markergmaps'));
		
		$mbs = uixul_ModuleBindingService::getInstance();
		$mbs->addImportInPerspective('website', 'markergmaps', 'website.perspective');
		$mbs->addImportInActions('website', 'markergmaps', 'website.actions');
		$result = $mbs->addImportform('website', 'modules_markergmaps/markergmaps');
		if ($result['action'] == 'create')
		{
			uixul_DocumentEditorService::getInstance()->compileEditorsConfig();
		}
		f_permission_PermissionService::getInstance()->addImportInRight('website', 'markergmaps', 'websiterights');
	}
}