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
        	<td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            		<td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
                </tr>
            </table></td>
     	</tr>  
      	<tr>
        	<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          		<tr>
            		<td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              			<tr class="dataTableHeadingRow">
                			<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PURCHASES_ID; ?></td>
                			<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_OF_PURCHASE; ?></td>
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_PRODUCT; ?></td>
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_MANUFACTURER; ?></td>
                   			<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PRICE_PER_PIECE; ?></td>
                			<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PURCHASE_QUANTITY; ?></td>
                			<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SHIPPING_COST; ?></td>
                			<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_TOTAL_COST; ?></td>
							<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_AVERAGE_TOTAL_COST; ?></td>
                			<td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_PURCHASE_REMARKS; ?></td>
							<td class="dataTableHeadingContent" align="left"></td>
							<td class="dataTableHeadingContent" align="left"></td>
              			</tr>
                        
<?php

	$purchases_info_query = tep_db_query("select p.purchases_id, p.purchase_date, p.products_id, p.manufacturers_id, p.price_per_piece, p.purchase_quantity, p.shipping_cost, p.total_cost, p.average_total_cost, pr.purchase_remarks, pd.products_name, pm.manufacturers_name from " . TABLE_PURCHASES . " p, " . TABLE_PURCHASES_REMARKS . " pr, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " pm where p.purchases_id = pr.purchases_id and p.products_id = pd.products_id and p.manufacturers_id = pm.manufacturers_id order by p.purchases_id");
	
	while($row = tep_db_fetch_array($purchases_info_query)) {
	
?>                                                
                        
                       	<tr id="defaultSelected" class="dataTableRowSelected">
<?php
                            echo "<td class='dataTableContent'>" . $row[purchases_id] ."</td>";
                			echo "<td class='dataTableContent' align='center'>" . $row[purchase_date] . "</td>";
                			echo "<td class='dataTableContent' align='left'>" . $row[products_name] . "</td>";
                			echo "<td class='dataTableContent' align='left'>" . $row[manufacturers_name] . "</td>";
                			echo "<td class='dataTableContent' align='center'>" . $row[price_per_piece] . "</td>";
							echo "<td class='dataTableContent' align='center'>" . $row[purchase_quantity] . "</td>";
							echo "<td class='dataTableContent' align='center'>" . $row[shipping_cost] . "</td>";
							echo "<td class='dataTableContent' align='center'>" . $row[total_cost] . "</td>";
							echo "<td class='dataTableContent' align='center'>" . $row[average_total_cost] . "</td>";
							echo "<td class='dataTableContent' align='left'>" . $row[purchase_remarks] . "</td>";
							echo "<td class='dataTableContent' align='left'><a href='editpurchase.php?purId=" . $row[purchases_id] . "'>Edit</a></td>";
							echo "<td class='dataTableContent' align='left'><a href='deletepurchase.php?purId=" . $row[purchases_id] . "'>Delete</a></td>";

?>
              			</tr>
<?php
	}
?>
                        </table>

<?php
  

  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>