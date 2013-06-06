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
	require(DIR_WS_CLASSES . 'currencies.php');
		$currencies = new currencies();
 	
	$action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
				
				$parameters = array('products_name' => '',
			                        'products_id' => '',
  								    'purchase_date_of_input' => '',
					    			'purchase_date' => '',
								    'price_per_piece' => '',
								    'purchase_quantity' => '',
					    			'shipping_cost' => '',
								    'total_cost' => '',
									'average_total_cost' => '',
            			            'manufacturers_id' => '',
					    			'purchase_remarks' => '');
						
				$pInfo = new objectInfo($parameters);
					   
			    $manufacturers_array = array(array('id' => '', 'text' => TEXT_NONE));
    			$manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
    			while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
     			 $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                     			'text' => $manufacturers['manufacturers_name']);
    			}

  			  	$products_array = array(array('id' => '', 'text' => TEXT_NONE));
  			  	$products_query = tep_db_query("select products_id, products_name from " . TABLE_PRODUCTS_DESCRIPTION . " order by products_name");
    			while ($products = tep_db_fetch_array($products_query)) {
      			$products_array[] = array('id' => $products['products_id'],
										  'text' => $products['products_name']);
			    }
				
	if (tep_not_null($action)) {
    	switch ($action) {
			case 'submit':
        		if (isset($HTTP_GET_VARS['purchases_id'])) $purchases_id = tep_db_prepare_input($HTTP_GET_VARS['purchases_id']);

				$sql_data_array = array('products_id' => (int)tep_db_prepare_input($HTTP_POST_VARS['products_id']),
										'purchase_date_of_input' => tep_db_prepare_input($HTTP_POST_VARS['purchase_date_of_input']),
										'purchase_date' => tep_db_prepare_input($HTTP_POST_VARS['purchase_date']),
										'price_per_piece' => tep_db_prepare_input($HTTP_POST_VARS['price_per_piece']),
										'purchase_quantity' => (int)tep_db_prepare_input($HTTP_POST_VARS['purchase_quantity']),
			                            'shipping_cost' => tep_db_prepare_input($HTTP_POST_VARS['shipping_cost']),
            			                'total_cost' => tep_db_prepare_input($HTTP_POST_VARS['total_cost']),
										'average_total_cost' => tep_db_prepare_input($HTTP_POST_VARS['average_total_cost']),
                        			    'manufacturers_id' => (int)tep_db_prepare_input($HTTP_POST_VARS['manufacturers_id']));

			    tep_db_perform(TABLE_PURCHASES, $sql_data_array);
	
				$purchases = $sql_data_array;
				
	          	$purchases_id = tep_db_insert_id();
				
				$purchases_remarks_data_array = array('purchase_remarks' => tep_db_prepare_input($HTTP_POST_VARS['purchase_remarks']));
				
	            $insert_sql_data = array('purchases_id' => $purchases_id);                                     

            	$purchases_remarks_data_array = array_merge($purchases_remarks_data_array, $insert_sql_data);

            	tep_db_perform(TABLE_PURCHASES_REMARKS, $purchases_remarks_data_array);

		}

				$products_id = $purchases['products_id'];
				$products_quantity_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
				$products_quantity = tep_db_fetch_array($products_quantity_query);
				$products_quantity['products_quantity'];
				$purchase_quantity = $purchases['purchase_quantity'];
				if ($products_quantity['products_quantity'] == 0) {
					tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$purchase_quantity . "' where products_id = '" . (int)$products_id . "'");
				} else {
					$total_quantity = (int)$products_quantity['products_quantity'] + (int)$purchase_quantity . "</br>";
					tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . (int)$total_quantity . "' where products_id = '" . (int)$products_id . "'");
				}
				
				$form_action = 'submit';
				
				tep_redirect(FILENAME_VIEW_PURCHASES);
				
	}
	
	require(DIR_WS_INCLUDES . 'template_top.php');

?>
<script type="text/javascript"><!--
function doRound(x, places) {
  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
}

function updateTotal() {
  var pppValue = parseFloat(document.forms["inputPurchases"].price_per_piece.value);
  var pqtyValue = parseFloat(document.forms["inputPurchases"].purchase_quantity.value);
  var shpcstValue = parseFloat(document.forms["inputPurchases"].shipping_cost.value);  
  var totalValue = parseFloat(pppValue * pqtyValue + shpcstValue);
  var avgtotalValue = parseFloat(totalValue / pqtyValue);

  document.forms["inputPurchases"].total_cost.value = doRound(totalValue, 2);
  document.forms["inputPurchases"].average_total_cost.value = doRound(avgtotalValue, 2);

}

//--></script>

<?php echo tep_draw_form('inputPurchases', FILENAME_ADD_PRODUCT_INFO, '&action=submit', 'post', 'enctype="multipart/form-data"'); ?>

	<table border="0" width="100%" cellspacing="0" cellpadding="2">
		<tr>
			<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td class="pageHeading"><?php echo TEXT_HEADING_NEW_PURCHASE; ?></td>
					<td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
				</tr>
			</table></td>
		</tr>
		<tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
		</tr>
		<tr>
			<td><table border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td class="main"><?php echo TEXT_DATE_OF_INPUT; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('purchase_date_of_input', date('Y-m-d'), 'id="purchase_date_of_input"') . ' <small>(YYYY-MM-DD)</small>'; ?></td>
				</tr>
				<tr>
					<td class="main"><?php echo TEXT_DATE_OF_PURCHASE; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('purchase_date', $pInfo->purchase_date, 'id="purchase_date"') . ' <small>(YYYY-MM-DD)</small>'; ?></td>
				</tr>
				<tr>
					<td class="main"><?php echo TEXT_PRODUCTS_MANUFACTURER; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id); ?></td>
				</tr>
				<tr>
					<td class="main"><?php echo TEXT_PRODUCT_NAME; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('products_id', $products_array, $pInfo->products_id); ?></td>
				</tr>
				<tr bgcolor="#ebebff">
					<td class="main"><?php echo TEXT_PRICE_PER_PIECE; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('price_per_piece', $pInfo->price_per_piece, 'onkeyup="updateTotal()"'); ?></td>
				</tr>
				<tr bgcolor="#ebebff">
					<td class="main"><?php echo TEXT_PURCHASE_QUANTITY; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('purchase_quantity', $pInfo->purchase_quantity, 'onkeyup="updateTotal()"'); ?></td>
				</tr>
				<tr bgcolor="#ebebff">
					<td class="main"><?php echo TEXT_SHIPPING_COST; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('shipping_cost', $pInfo->shipping_cost, 'onkeyup="updateTotal()"'); ?></td>
				</tr>
<script type="text/javascript"><!--
updateTotal();
//--></script>
				<tr bgcolor="#ebebff">
					<td class="main"><?php echo TEXT_TOTAL_COST; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('total_cost', $pInfo->total_cost); ?></td>
				</tr>
				<tr bgcolor="#ebebff">
					<td class="main"><?php echo TEXT_AVERAGE_TOTAL_COST; ?></td>
					<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('average_total_cost', $pInfo->average_total_cost); ?></td>
				</tr>
				<tr>
					<td class="main" valign="top"><?php echo TEXT_PURCHASE_REMARKS; ?></td>
					<td><table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;'; ?></td>
							<td class="main"><?php echo tep_draw_textarea_field('purchase_remarks', 'soft', '70', '15', (empty($pInfo->purchases_id) ? '' : tep_get_purchases($pInfo->purchases_id))); ?></td>
						</tr>
					</table></td>
				</tr>
			</table>
		</tr>
		<tr>
			<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
		</tr>
		<tr>
			<td class="smallText" align="right"><?php echo tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link(FILENAME_ADD_PRODUCT_INFO)); ?></td>
		</tr>
	</table>
<script type="text/javascript">
$('#purchase_date').datepicker({
  dateFormat: 'yy-mm-dd'
});
</script>
</form>
<?php
	require('includes/application_bottom.php');  
	require(DIR_WS_INCLUDES . 'template_bottom.php');
?>
