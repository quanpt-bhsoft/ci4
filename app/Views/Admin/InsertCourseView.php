<?php $this->extend('layouts/LayoutInsert');
$this->section('content');
?>
<div class="container">
  <h2>INSERT COURSE</h2>
  <?php
  if (isset($validation)) {
    echo $validation->listErrors();
  }
  ?>
  <form class="form-horizontal" enctype="multipart/form-data" action="insert_course" method="post" autocomplete="off">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Name :</label>
      <div class="col-sm-10">
        <input required="" type="text" class="form-control" id="email" name="name" value="">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Price :</label>
      <div class="col-sm-10">
        <input required="" type="text" class="form-control" id="email" name="price" value="">
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
      <label class="control-label col-sm-2" for="email">Title :</label>
      <div class="col-sm-10">
        <input required="" type="text" class="form-control" name="title">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Describle :</label>
      <div class="col-sm-10">
        <input required="" type="text" class="form-control" id="email" name="describe" value="">
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input style="background : #007bff" type="submit" name="dangky" value="upload" onclick="return validate()">
      </div>
    </div>
  </form>
</div>
<?php $this->Endsection(); ?>