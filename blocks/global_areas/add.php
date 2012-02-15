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
 
//get the url to our tool
$tool = Loader::helper('concrete/urls')->getToolsURL('get_area_list', 'global_areas');
?>
<script type="text/javascript">
   gachange = function(cID, cName) {
	/* preform the basic html changing of the page selector */ 
	
      $('input#[name=\'targetCID\']').val(cID);
      $('.ccm-summary-selected-item-inner').html('<strong class="ccm-summary-selected-item-label">' + cName + '</strong>');
      
      $('#global_area_list').html('');
      
      /* Loading... Loading... Still Loading... */
     $('#loading').html('<?php  echo t("Loading...")?>');
     
     $.getJSON('<?php   echo $tool."?cID="?>' + cID + '', function(areas) {
		var items = [];
		
		$.each(areas, function(key, val) {
			items.push('<option value="' + val + '">' + val + '</option>');
		});
		
		/* clear the area each time we choose a page, otherwise you get a bunch of areas or loadings... */
		$('#loading').html('');
		
		$('<select/>', {
			'id': 'tarHandle',
			'class': 'global_areas',
			'name': 'tarHandle',
			html: items.join('')
		}).appendTo('#global_area_list');
	});
};
</script>

<div id="global_areas_block">
	<div class="page_selector">
		<?php  echo Loader::helper('form/page_selector')->selectPage('targetCID', '0', 'gachange'); ?>
	</div>
	<fieldset>
		<label for="tarHandle"><?php  echo t('Pick an area:')?></label>
		<div id="loading">
			<?php  echo t('<u>Please select a page first!</u>')?>
		</div>
		
		<div id="global_area_list">
		</div>
		<p><?php  echo t('<em>*Note:</em> If an area does not appear, then there are no blocks in that area or the area does not exist.')?></p>
	</fieldset>
</div>