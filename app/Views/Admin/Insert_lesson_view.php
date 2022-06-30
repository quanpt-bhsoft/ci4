<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
<div class="container">
<h2>Insert Lesson</h2>
<form class="form-horizontal" enctype = "multipart/form-data" action="insert_lesson" method= "post" autocomplete ="off">
<div class="form-group">
   <label class="control-label col-sm-2" for="email" >Title :</label>
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
            <?php  foreach($get_course as $get_course): ?>
            <option value="<?php echo $get_course['ID'] ?>" ><?php echo $get_course['Name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="form-group">        
  <div class="col-sm-offset-2 col-sm-10" >
    <input class="btn btn-default" style = "background : #007bff"type="submit" name="dangky" value="Save Data">
  </div>
</div>
</form>
</div>
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>