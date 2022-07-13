<?php $this->extend('layouts/LayoutInsert');
$this->section('content');
?>
<div class="container">
   <h2>Update Lesson</h2>
   <?php
   if (isset($validation)) {
      echo $validation->listErrors();
   }
   ?>
   <form class="form-horizontal" enctype="multipart/form-data" action="update_lesson" method="post" autocomplete="off">
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">ID :</label>
         <div class="col-sm-10">
            <input readonly type="text" class="form-control" id="email" name="id" value="<?php echo $getLesson[0]['ID'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Title :</label>
         <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="title" value="<?php echo $getLesson[0]['Title'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Content :</label>
         <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="content" value="<?php echo $getLesson[0]['Content'] ?>">
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