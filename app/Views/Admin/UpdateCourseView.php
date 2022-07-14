<?php $this->extend('layouts/LayoutInsert');
$this->section('content');
?>
<div class="container">
   <h2>Update Course</h2>
   <form class="form-horizontal" enctype="multipart/form-data" action="update_course" method="post" autocomplete="off">
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">ID :</label>
         <div class="col-sm-10">
            <input readonly required="" type="text" class="form-control" id="email" name="id" value="<?php echo $getCourse['ID'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Name :</label>
         <div class="col-sm-10">
            <input required="" type="text" class="form-control" id="email" name="name" value="<?php echo $getCourse['Name'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Price :</label>
         <div class="col-sm-10">
            <input required="" type="text" class="form-control" id="email" name="price" value="<?php echo $getCourse['Price'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Title :</label>
         <div class="col-sm-10">
            <input required="" type="text" class="form-control" id="email" name="title" value="<?php echo $getCourse['Title'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Avatar :</label>
         <div class="col-sm-10">
            <img id="imagePreview" style="width:7em; height : 7em;" src="<?php
                                                                           if (strpos($getCourse['Avatar'], 'via') == 8) {
                                                                              echo $getCourse['Avatar'];
                                                                           } else {
                                                                              echo base_url("../uploads/" . $getCourse['Avatar']) ;
                                                                           }
                                                                           ?>" alt="Image">
            <input required="" type="file" name="userfile" size="20">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Describe :</label>
         <div class="col-sm-10">
            <input style="height: auto;" required="" type="text" class="form-control" id="email" name="describe" value="<?php echo $getCourse['Describe'] ?>">
         </div>
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