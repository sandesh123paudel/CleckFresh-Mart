<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?php
/* 
 * PayPal and database configuration 
 */

// PayPal configuration 
define('PAYPAL_ID', 'sb-a8g47b24751837@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

define('PAYPAL_RETURN_URL', 'http://localhost/CleckFreshMart/payment/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/CleckFreshMart/customer/homepage.php');

define('PAYPAL_CURRENCY', 'USD');

// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");
