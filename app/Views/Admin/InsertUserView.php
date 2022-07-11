<?php $this->extend('layouts/LayoutInsert');
$this->section('content');
?>
<div class="container">
  <h2>INSERT USER</h2>
  <?php
  if (isset($validation)) { ?>
    <?= $validation->listErrors(); ?>
  <?php }
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" action="insert_user" method="post" autocomplete="off">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Name :</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" name="name" value="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email :</label>
      <div class="col-sm-10">
        <input required="" type="email" class="form-control" id="email" name="email" value="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Password :</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" id="pass" name="pass">
        <span id="password"></span>
        <span id="password_error"></span>
      </div>

    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email" name="avatar">Avatar :</label>
      <div class="col-sm-10">
        <!-- File input field -->
        <input type="file" id="file" onchange="return fileValidation()" name="userfile" size="20" />
        <!-- Image preview -->
        <div id="imagePreview"></div>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Status :</label>
      <div class="col-sm-10">
        <input required="" type="" class="form-control" id="email" name="status" value="">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input style="background : #007bff" type="submit" name="dangky" value="upload">
      </div>
    </div>
  </form>
</div>
<?php $this->Endsection(); ?>