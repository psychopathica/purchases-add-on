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

  $cl_box_groups[] = array(
    'heading' => BOX_HEADING_PURCHASES,
    'apps' => array(
	  array(
        'code' => FILENAME_ADD_PRODUCT_INFO,
        'title' => BOX_ADD_BUSINESS_PURCHASE,
        'link' => tep_href_link(FILENAME_ADD_PRODUCT_INFO)
      ),
	  array(
        'code' => FILENAME_VIEW_PURCHASES,
        'title' => BOX_VIEW_PURCHASES,
        'link' => tep_href_link(FILENAME_VIEW_PURCHASES)
      ),
      array(
        'code' => FILENAME_ORDERS,
        'title' => BOX_VIEW_CUSTOMER_ORDER,
        'link' => tep_href_link(FILENAME_ORDERS)
      ),
	  array(
        'code' => FILENAME_VIEW_INVENTORY,
        'title' => BOX_VIEW_INVENTORY,
        'link' => tep_href_link(FILENAME_VIEW_INVENTORY)
      ),
	)
  );
?>