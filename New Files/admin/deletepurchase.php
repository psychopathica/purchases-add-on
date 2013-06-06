<?php
/* 
Sourcerers
Copyright (c) 2013 Del, Jordon Koh, Low Guan Hong
Released under the GNU General Public License Version 3

This file is part of Sourcerers

Sourcerers is free software: you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by
the Free Software Foundation, version 3 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

A copy of the GNU General Public License is enclosed.
************************************************************************
For any enquiries, contact Del via email at magnadel@hotmail.com, Jordon Koh at jordonkoh@hotmail.com, or Low Guan Hong at grapefood@hotmail.com
*/
  	require('includes/application_top.php');

$purId = $_GET['purId'];

$purchase_query = tep_db_query("select purchase_quantity, products_id from " . TABLE_PURCHASES . " where purchases_id = '" . $purId . "'");
$purchase_array = tep_db_fetch_array($purchase_query);

$product_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . $purchase_array['products_id'] . "'");
$product_array = tep_db_fetch_array($product_query);

$total_quantity = (int)$product_array['products_quantity'] - (int)$purchase_array['purchase_quantity'];

$update_quantity = tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$total_quantity . "' where products_id = '" . (int)$purchase_array['products_id'] . "'");

$delete_purchase_query = tep_db_query("delete from " . TABLE_PURCHASES . " where purchases_id = '" . $purId . "'");
$delete_purchase_remark_query = tep_db_query("delete from " . TABLE_PURCHASES_REMARKS . " where purchases_id = '" . $purId . "'");

$purchase_num_query = tep_db_query("select purchases_id from " . TABLE_PURCHASES . " order by purchases_id DESC");
$purchase_num_array = tep_db_fetch_array($purchase_num_query);
$reduce_auto_increment = tep_db_query("alter table " . TABLE_PURCHASES . " auto_increment =" . $purchase_num_array['purchases_id'] . "");


tep_redirect(FILENAME_VIEW_PURCHASES);
	
	require('includes/application_bottom.php');  

?>