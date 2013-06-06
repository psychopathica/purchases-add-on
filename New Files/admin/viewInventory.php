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
  	require(DIR_WS_INCLUDES . 'template_top.php');

?>

	<table border="0" width="100%" cellspacing="0" cellpadding="2"> 
      	<tr>
        	<td width="100%"><table border="0" width="70%" align='center' cellspacing="0" cellpadding="0">
          		<tr>
            		<td class="pageHeading"><?php echo HEADING_TITLE, date("M-d-Y"); ?></td>
            		<td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
                </tr>
            </table></td>
     	</tr>  
      	<tr>
        	<td><table border="0" width="70%" align='center' cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              			<tr class="dataTableHeadingRow">
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_PRODUCT; ?></td>
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_MANUFACTURER; ?></td>
							<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CURRENT_QUANTITY; ?>&nbsp;</td>
              			</tr>
<?php
	$inventory_query = tep_db_query("select p.products_id, p.manufacturers_id, p.products_quantity, pd.products_name, pm.manufacturers_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " pm where p.products_id = pd.products_id and p.manufacturers_id = pm.manufacturers_id order by pd.products_name");
                                                
	while($row = tep_db_fetch_array($inventory_query)) {		
?>         
                       	<tr id="defaultSelected" class="dataTableRowSelected">
<?php
                			echo "<td class='dataTableContent' align='left'>" . $row[products_name] . "</td>";
                			echo "<td class='dataTableContent' align='left'>" . $row[manufacturers_name] . "</td>";
							echo "<td class='dataTableContent' align='center'>" . $row[products_quantity] . "</td>";
	}
?>                                       
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
		<tr>
        	<td width="100%"><table border="0" width="70%" align='center' cellspacing="0" cellpadding="0">
				<tr>
            		<td class="pageHeading"><?php echo HEADING_STOCK_IN_TITLE; ?></td>
            		<td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
                </tr>
            </table></td>
     	</tr>  
      	<tr>
        	<td><table border="0" width="70%" align='center' cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              			<tr class="dataTableHeadingRow">
                			<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DATE; ?></td>
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_PRODUCT; ?></td>
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_MANUFACTURER; ?></td>
                			<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PURCHASE_QUANTITY; ?>&nbsp;</td>
              			</tr>
<?php	
	$purchase_query = tep_db_query("select p.purchase_date, p.products_id, p.manufacturers_id, p.purchase_quantity, pd.products_name, pm.manufacturers_name from " . TABLE_PURCHASES . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " pm where p.products_id = pd.products_id and p.manufacturers_id = pm.manufacturers_id order by p.purchase_date");
                                                
	while($row = tep_db_fetch_array($purchase_query)) {	
?>                                                
                        
                       	<tr id="defaultSelected" class="dataTableRowSelected">
<?php
                            echo "<td class='dataTableContent' width='150px'>" . $row[purchase_date] . "</td>";
                			echo "<td class='dataTableContent' align='left' width='400px'>" . $row[products_name] . "</td>";
                			echo "<td class='dataTableContent' align='left' width='300px'>" . $row[manufacturers_name] . "</td>";
							echo "<td class='dataTableContent' align='center'>" . $row[purchase_quantity] . "</td>";
	}
?>
              			</tr>
                	</table></td>
            	</tr>
         	</table></td>
     	</tr>
        <tr>
        	<td width="100%"><table border="0" width="70%" align='center' cellspacing="0" cellpadding="0">
          		<tr>
            		<td class="pageHeading"><?php echo HEADING_STOCK_OUT_TITLE; ?></td>
            		<td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
                </tr>
            </table></td>
     	</tr>  
      	<tr>
        	<td><table border="0" width="70%" align='center' cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              			<tr class="dataTableHeadingRow">
                			<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DATE; ?></td>
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_PRODUCT; ?></td>
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_MANUFACTURER; ?></td>
							<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_ORDER_QUANTITY; ?>&nbsp;</td>
              			</tr>
<?php	
	$order_query = tep_db_query("select op.orders_products_id, o.orders_id, op.products_name, pm.manufacturers_name, op.products_quantity, date_format(o.date_purchased, '%Y-%m-%d') as date_purchased from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_PRODUCTS . " p, " . TABLE_MANUFACTURERS . " pm where o.orders_id = op.orders_id and op.products_id = p.products_id and p.manufacturers_id = pm.manufacturers_id order by o.date_purchased");
                                                
	while($row = tep_db_fetch_array($order_query)) {	
?>                                                
                        
                       	<tr id="defaultSelected" class="dataTableRowSelected">
<?php
                            echo "<td class='dataTableContent' width='150px'>" . $row[date_purchased] . "</td>";
                			echo "<td class='dataTableContent' align='left' width='400px'>" . $row[products_name] . "</td>";
                			echo "<td class='dataTableContent' align='left' width='300px'>" . $row[manufacturers_name] . "</td>";
							echo "<td class='dataTableContent' align='center'>" . $row[products_quantity] . "</td>";
	}
?>
						</tr>
					</table></td>
				</tr>
			</table></td>
		</tr>
	</table>
<?php

  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>