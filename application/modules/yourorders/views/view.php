<h1><?= $order_ref ?></h1>
<p style="font-weight: bold;">Date Created: <?= $date_created ?></p>
<p style="font-weight: bold;">Date Created: <?= $order_status_title ?></p>
<?php

	$user_type = 'public';
	echo Modules::run('cart/_draw_cart_content', $query_cc, $user_type); 
	?>