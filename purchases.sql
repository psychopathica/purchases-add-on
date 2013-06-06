CREATE TABLE IF NOT EXISTS `purchases` (
  `purchases_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) DEFAULT NULL,
  `manufacturers_id` int(11) DEFAULT NULL,
  `purchase_date_of_input` date NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `price_per_piece` decimal(15,2) NOT NULL,
  `purchase_quantity` int(4) NOT NULL,
  `shipping_cost` decimal(15,2) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `average_total_cost` decimal(15,2) NOT NULL,
  PRIMARY KEY (`purchases_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `purchases_remarks` (
  `purchases_id` int(11) NOT NULL,
  `purchase_remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
