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
 
$tool = Loader::helper('concrete/urls')->getToolsURL('get_area_list', 'global_areas');
$targetCID = $controller->targetCID;
$name = Page::getByID($targetCID)->getCollectionName();
$tarHandle = $controller->tarHandle;
?>

<script type="text/javascript">
   gachange = function(cID, cName) {
	/* preform the basic html changing of the page selector */ 
	
      $('input#[name=\'targetCID\']').val(cID);
      $('.ccm-summary-selected-item-inner').html('<strong class="ccm-summary-selected-item-label">' + cName + '</strong>');
      
      /* clear the area each time we choose a page, otherwise you get a bunch of areas */
     $('#global_area_list').html('');
     
      /* Loading... Loading... Still Loading... */
     $('#loading').html('<?php  echo t("Loading...")?>');
     
      /* use JSON to get the area names from our tool $tool */
     $.getJSON('<?php   echo $tool."?cID="?>' + cID + '', function(areas) {
		var items = [];
		var area = '<?php   echo $tarHandle ?>';
		
		/* for each entry built the select html */
		$.each(areas, function(key, val) {
			if(val == area) {
				items.push('<option value="' + val + '" selected="selected">' + val + '</option>');
			} else {
				items.push('<option value="' + val + '">' + val + '</option>');
			}
		});
		
		$('#loading').html('');
		
		/* add the select to the page */
		$('<select/>', {
			'id': 'tarHandle',
			'class': 'global_areas',
			'name': 'tarHandle',
			html: items.join('')
		}).appendTo('#global_area_list');
	});
   }
</script>

<div id="global_areas_block">
	<div class="page_selector">
		<?php  echo Loader::helper('form/page_selector')->selectPage('targetCID', $targetCID, 'gachange'); ?>
	</div>
	<fieldset>
	<label for="tarHandle"><?php  echo t('Pick an area:')?></label>
	<div id="loading">
	</div>
	
	<div id="global_area_list">	
	</div>
	<p><?php  echo t('<em>*Note:</em> If an area does not appear, then there are no blocks in that area or the area does not exist.')?></p>
	</fieldset>
</div>
<?php  if($targetCID) { ?>
	<script type="text/javascript">
		$(document).ready(function() {
		   gachange('<?php  echo $targetCID?>', '<?php  echo $name?>');
		 });
	</script>
<?php  } ?>