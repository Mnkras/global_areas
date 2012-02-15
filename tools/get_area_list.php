<?php   
defined('C5_EXECUTE') or die("Access Denied.");

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

/**
 * Tool where we get generate an array of area handles that we later retreive with json.
 * @access private
 */
$dh = Loader::helper('concrete/dashboard/sitemap');
if ($dh->canRead()) { 
	$cID = $_GET['cID'];
	if(!empty($cID) && intval($cID)) {
	
		$db = Loader::db();
		$r = $db->query('SELECT *  FROM `Areas` WHERE `cID` = ?', $cID);
		$areas = array();
		
		while ($row = $r->fetchRow()) {
			$areas[] = $row['arHandle'];
		}
		
		$json = Loader::helper('json');
		echo $json->encode($areas);
		
	}
} else {
	die(t('Access Denied'));
}