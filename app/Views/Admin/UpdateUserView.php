<?php $this->extend('layouts/LayoutInsert');
$this->section('content');
?>
<div class="container">
   <h2>Update USER</h2>
   <?php
   if (isset($validation)) { ?>
      <?= $validation->listErrors(); ?>
   <?php }
   ?>
   <form class="form-horizontal" enctype="multipart/form-data" method="post" autocomplete="off">
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">ID :</label>
         <div class="col-sm-10">
            <input readonly required="" type="text" class="form-control" id="email" name="id" value="<?php echo $getuser['ID'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Name :</label>
         <div class="col-sm-10">
            <input required="" type="text" class="form-control" id="email" name="name" value="<?php echo $getuser['Name'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Email :</label>
         <div class="col-sm-10">
            <input required="" type="email" class="form-control" id="email" name="email" value="<?php echo $getuser['Email'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Password :</label>
         <div class="col-sm-10">
            <input required="" type="password" class="form-control" id="email" name="pass" value="<?php echo $getuser['Password'] ?>">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Avatar :</label>
         <div class="col-sm-10">
            <img style="width:7em; height : 7em;" src="<?php echo base_url("../uploads/" . $getuser['Avatar']); ?>" alt="Image">
            <input type="file" name="userfile" size="20">
         </div>
      </div>
      <div class="form-group">
         <label class="control-label col-sm-2" for="email">Status :</label>
         <div class="col-sm-10">
            <select name="status" required="" type="" class="form-control" id="email" name="status" >
                  <option value="<?php echo $getuser['Status']?>">
                     <?php if($getuser['Status'] == 1){
                        echo 'Admin';
                        } else {
                           echo 'User';
                        }
                        ?>
                  </option>
                  <option value="<?php if($getuser['Status'] == 1){
                        echo 0;
                        } else {
                           echo 1 ;
                        } ?>"><?php if($getuser['Status'] == 1){
                           echo 'User';
                           } else {
                              echo 'Admin' ;
                           } ?>
                  </option>
            </select>
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