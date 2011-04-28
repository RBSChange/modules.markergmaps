<?php
class markergmaps_Setup extends object_InitDataSetup
{
	public function install()
	{
		try
		{
			$scriptReader = import_ScriptReader::getInstance();
       	 	$scriptReader->executeModuleScript('markergmaps', 'init.xml');
		}
		catch (Exception $e)
		{
			echo "ERROR: " . $e->getMessage() . "\n";
			Framework::exception($e);
		}

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

	/**
	 * @return array<string>
	 */
	public function getRequiredPackages()
	{
		// Return an array of packages name if the data you are inserting in
		// this file depend on the data of other packages.
		// Example:
		// return array('modules_website', 'modules_users');
		return array();
	}
}