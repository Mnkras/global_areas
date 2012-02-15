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

ccmValidateBlockForm = function() {
	if ($("input#[name='targetCID']").val() == '' || $("input#[name='targetCID']").val() == 0) { 
		ccm_addError(ccm_t('page-required'));
	}
	if ($("#tarHandle").val() == '') {
		ccm_addError(ccm_t('area-required'));
	}
	return false;
}