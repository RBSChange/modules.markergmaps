<?php
/**
 * markergmaps_patch_0300
 * @package modules.markergmaps
 */
class markergmaps_patch_0300 extends patch_BasePatch
{

    /**
     * Returns true if the patch modify code that is versionned.
     * If your patch modify code that is versionned AND database structure or content,
     * you must split it into two different patches.
     * @return Boolean true if the patch modify code that is versionned.
     */
	public function isCodePatch()
	{
		return true;
	}
 
	/**
	 * Entry point of the patch execution.
	 */
	public function execute()
	{
		f_permission_PermissionService::getInstance()->addImportInRight('website', 'markergmaps', 'websiterights');
		exec("change.php compile-roles");
		exec("change.php compile-permissions");
	}

	/**
	 * @return String
	 */
	protected final function getModuleName()
	{
		return 'markergmaps';
	}

	/**
	 * @return String
	 */
	protected final function getNumber()
	{
		return '0300';
	}
}