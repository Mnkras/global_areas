<?php   

/**
 * Global Areas block
 *
 * @package Blocks
 * @subpackage BlockTypes
 * @author Michael Krasnow <mike@c5rockstars.com>
 * @category Packages
 * @copyright  Copyright (c) 2011 Michael Krasnow. (http://www.c5rockstars.com)
 *
 */
 
defined('C5_EXECUTE') or die("Access Denied.");

class GlobalAreasPackage extends Package {

	protected $pkgHandle = 'global_areas';
	protected $appVersionRequired = '5.4.0';
	protected $pkgVersion = '1.1';
	
	public function getPackageName() {
		return t("Global Areas");
	}
	
	public function getPackageDescription() {
		return t("Pull areas from other pages on your site into a different page.");
	}
	
	public function install() {
		$pkg = parent::install();
		BlockType::installBlockTypeFromPackage("global_areas", $pkg);
	}

}