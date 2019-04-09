<?php
echo Modules::run('templates/_draw_breadcrumbs', $breadcrumbs_data);
if (isset($flash)) {
	echo $flash;
}
?>

<script type="text/javascript">
	var myApp = angular.module('myApp', []);

myApp.controller('myController', ['$scope', function ($scope) {
	// body...
	$scope.defaultpic = '<?= $gallery_pics['0'] ?>';

	$scope.change = function(newPic){
		$scope.defaultpic = newPic;
	}
    
}])
</script>


<h1 style="color: red;">Gallery Version!</h1>



<div class="row" ng-controller="myController">
	<div class="col-md-1" style="margin-top: 24px;">
	<?php
      foreach ($gallery_pics as $thumbnail) {
      	?>
      	  <img ng-click="change('<?= $thumbnail ?>')" src="<?= $thumbnail ?>" class="img-responsive">
      	<?php
      }
	?>
	</div>
	<div class="col-md-4" style="margin-top: 24px;">
		<a href="#" data-featherlight="{{ defaultpic }}">
		<img src="{{ defaultpic }}" class="img-responsive" style="margin-top: 24px;">
		</a>
	</div>
	<div class="col-md-4">
		<h1><?= $item_title;?></h1>
		<h2>Our Price<?= number_format($item_price,2) ?></h2>
		<div style="clear: both;">
			<?= nl2br($item_description);?>
		</div>
	</div>
	<div class="col-md-3">
		<?= Modules::run('cart/_draw_add_to_cart', $update_id);?>
	</div>
</div>
