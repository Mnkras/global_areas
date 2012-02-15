<?php    defined('C5_EXECUTE') or die("Access Denied.");

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
 
class GlobalAreasBlockController extends BlockController {

	protected $btTable = 'btGlobalAreas';
	protected $btInterfaceWidth = "250";
	protected $btInterfaceHeight = "200";
	
	protected $btCacheBlockOutput = false;
	protected $btCacheBlockOutputOnPost = false;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	
	/**
	 * Returns the translateable string of the block Name
	 *
	 * @return string Translateable string of the block Name.
	 */
	 
	public function getBlockTypeName() {
		return t("Global Areas");
	}
	
	/**
	 * Returns the translateable string of the block description
	 *
	 * @return string Translateable string of the block description.
	 */
	 
	public function getBlockTypeDescription() {
		return t("Get an area from another page and put it on this page.");
	}
	
	/**
	 * Returns the translateable strings uses in block validation
	 *
	 * @return array Array of strings.
	 */
	
	public function getJavaScriptStrings() {
		return array('page-required' => t('Please select a page.'), 'area-required' => t('Please choose an area.'));
	}
	
	public function save($args) {
		parent::save($args);
	}
	
	/**
	 * Gets an array of blocks and adds to the block's header
	 *
	 * @return void
	 */
	 
	public function outputAutoHeaderItems(){ 
	
		$page = Page::getByID($this->targetCID);
		$area = new Area($this->tarHandle);
		$areas = $area->getAreaBlocksArray($page);

		if (is_array($areas)) {
			
			// grab this block's header items
			$b = $this->getBlockObject();
			$bvt = new BlockViewTemplate($b);
			$headers = $bvt->getTemplateHeaderItems();

			// grab child blocks' header items and merge together
			foreach($areas as $block){
				$controller = $block->getInstance();
				if($controller instanceof BlockController && method_exists($controller, 'on_page_view')) {
					$controller->on_page_view();
				}
				
				$bvt = new BlockViewTemplate($block);
				$headers = array_merge($headers,$bvt->getTemplateHeaderItems());
			}
	
			// add all of the header items
			if (count($headers) > 0){ 
				foreach($headers as $h){ 
					$this->addHeaderItem($h); 
				}
			} 
		}
	}
	
	/**
	 * Returns the number of blocks in the area
	 *
	 * @return array
	 */
	 
	public function getNumberOfBlocks() {
		$page = Page::getByID($this->targetCID);
		$area = new Area($this->tarHandle);
		$areas = $area->getAreaBlocksArray($page);
		return count($areas);
	}
}