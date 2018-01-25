<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Editable Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<p id="header">INVOICE</p>
		
		<div id="identity">
		
            <p id="address">Chris Coyier<br />
123 Appleseed Street<br />
Appleville, WI 53719<br />
<br />
Phone: (555) 555-5555</p>

		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <p id="customer-title">Widget Corp.<br />
			sc/o Steve Widget</p>

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td>000123</td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td id="date">December 15, 2009</td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">$875.00</div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Item</th>
		      <th>Description</th>
		      <th>Unit Cost</th>
		      <th>Quantity</th>
		      <th>Price</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name"><div>Web Updates</div></td>
		      <td class="description">Monthly web updates for http://widgetcorp.com (Nov. 1 - Nov. 30, 2009)</td>
		      <td class="cost">$650.00</td>
		      <td class="qty">1</td>
		      <td><span class="price">$650.00</span></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">$875.00</div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>
		</div>
	
	</div>
	
</body>

</html>