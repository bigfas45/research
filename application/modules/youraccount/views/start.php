
<h1>Create Account </h1>
<?php
$form_location = base_url().'youraccount/submit';
echo validation_errors("<p style='color: red;'>", "</p>");
?>
<form class="form-horizontal" action="<?=$form_location?>" method="post">
<fieldset>

<!-- Form Name -->
<legend>Please Submit Your Details Using The Form Below</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Username</label>  
  <div class="col-md-4">
  <input id="textinput" name="username" type="text" value="<?=$username?>" placeholder="Enter your username of choice" class="form-control input-md" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">E-mail</label>  
  <div class="col-md-4">
  <input id="textinput" name="email" type="text" value="<?=$email?>" placeholder="Enter your contact email address" class="form-control input-md">
  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Password</label>  
  <div class="col-md-4">
  <input id="textinput" name="pword" type="password" value="<?=$pword?>"  placeholder="Enter your password of choice" class="form-control input-md">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Repeat Password</label>  
  <div class="col-md-4">
  <input id="textinput" name="repeat_pword" value="<?=$repeat_pword?>" type="password" placeholder="Please Repeat Password here" class="form-control input-md">
  </div>
</div>

<
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton">Create Account?</label>
  <div class="col-md-4">
    <button id="singlebutton" name="submit" value="Submit" class="btn btn-primary">Yes</button>
  </div>
</div>

</fieldset>
</form>
