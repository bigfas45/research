<div class="row-fluid">
	<div class="span12 statbox" style="background-color: #c0c0c0">
		<div class="span4">
			<img src="<?= base_url() ?>adminfiles/img/paypal_logo.png">
		</div>

		<div class="span8">
			<h2>FEEDBACK FROM PAYPAL</h2>
			<p>
				<b>Transmission Time:</b> <?= $date_created ?></br>
				<b>Payment Status:</b> <?= $payment_status ?></b>
				<b>Transaction ID: </b> <?= $txn_id ?></b>
				<b>Payment Gross:</b> <?= $mc_gross ?></b>
				<b>Payer ID:</b> <?= $payer_id ?></b>
				<b>Payer Email:</b> <?= $payer_email ?></b>
				<b>Payer Status:</b> <?= $payment_date ?></b>
				<b>Payment Date:</b> <?= $payment_date ?></b>


				<!-- Payer's detatils -->
				<b>Payer's name:</b> <?= $first_name. ' '.$last_name ?></b>
				<b>Payer's Company:</b><?= $payer_business_name?></b>
				<b>Address Line 1:</b><?= $address_name ?><br>
				<b>Adress Line 2:</b><?= $address_street ?><br>
				<b>City:</b><?= $address_city ?><br>
				<b>Sate:</b><?= $address_state ?><br>
				<b>Postcose/zip:</b><?= $address_zip?><br>
				<b>Country:</b></p><?= $address_country ?><br>



			</p>
		</div>

		<div class="footer">
			<a href="http://www.paypal.co.uk"> Check Paypal for more info</a>
		</div>	
	</div>
</div>
