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

//get the current page object
$c = Page::getCurrentPage();
//get the current page's ID
$page = $c->getCollectionID();
$target = Page::getByID($targetCID, 'ACTIVE');
$name = $target->getCollectionName();

//make sure the page isn't the same as the area that we are going to show
if($c->isEditMode()) {
	echo '<div class="ccm-edit-mode-disabled-item">';
	echo '<div style="padding:8px 0px;">'.t("Currently pulling blocks from the area \"%s\" on the page \"%s\".<br />To edit the blocks please go to that page.", $tarHandle, $name).'</div>';
	echo '</div>';
}
if($c->isEditMode() && $controller->getNumberOfBlocks() == 0) {
	echo '<div class="ccm-edit-mode-disabled-item">';
	echo '<div style="padding:8px 0px;">'.t("There are no blocks in this area!").'</div>';
	echo '</div>';
}
if($page != $targetCID) {

	$a = new Area($tarHandle);
	$a->disableControls();
	$a->display($target);

} else if($c->isEditMode()) { //otherwise, if its editmode show a nice message

	echo '<div class="ccm-edit-mode-disabled-item">';
	echo '<div style="padding:8px 0px;">'.t("You cannot choose an area on the same page!").'</div>';
	echo '</div>';

}
?>