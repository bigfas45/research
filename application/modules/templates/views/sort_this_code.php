<?php
$first_bit = $this->uri->segment(1);
$third_bit = $this->uri->segment(3);

if($third_bit !=""){
//we have three segments on the URL, so...
$start_of_target_url = "../../";
}
else{
//we probably have two segments on the URL, so...

$start_of_target_url = "../";
}
?>
<script type="text/javascript" src="<?php echo base_url();?>adminfiles/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>adminfiles/jquery-ui.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

$("#sortlist").sortable({
stop:function(event, ui) {saveChanges();}
});
$("#sortlist").disableSelection();

});

function saveChanges()
{
var $num = $('#sortlist > li').size();
$dataString = "number=" +$num;
for($x=1;$x<=$num;$x++)
{
var $catid = $('#sortlist li:nth-child('+$x+')').attr('id');
$dataString = $dataString + "&order"+$x+"="+$catid;

} $.ajax({
type: "POST",
url: "<?php echo $start_of_target_url.$first_bit; ?>/sort",
data: $dataString

});

return false;
}
</script>

