<?php $this->extend('layouts/LayoutInsert');
$this->section('content');
?>
<div class="container">
  <h2>Insert Lesson</h2>
  <form class="form-horizontal" enctype="multipart/form-data" action="insert_lesson" method="post" autocomplete="off">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Title :</label>
      <div class="col-sm-10">
        <input required="" type="text" class="form-control" id="email" name="title">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Content :</label>
      <div class="col-sm-10">
        <input required="" type="text" class="form-control" id="email" name="content">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Course :</label>
      <div class="col-sm-10">
        <select name="course">
          <?php foreach ($getCourse as $getCourse) : ?>
            <option value="<?php echo $getCourse['ID'] ?>"><?php echo $getCourse['Name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input class="btn btn-default" style="background : #007bff" type="submit" name="dangky" value="Save Data">
      </div>
    </div>
  </form>
</div>
<?php $this->Endsection(); ?>