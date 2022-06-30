<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script>  
        function getValue(id)
        {
            return document.getElementById(id).value.trim();
        }

                // Hiển thị lỗi
        function showError(key, mess)
        {
            document.getElementById(`${key}_error`).innerHTML = mess;
        } 
        function validate()
        {
                  
            let flag = true;
            let password = getValue('pass');
            let regex_string = /\D/;
            let regex_number = /\d/;
            let check_string = password.match(regex_string);
            let check_number = password.match(regex_number);
            if (password.length < 6 || regex_string == null || regex_number == null)
            {
                flag = false;
                showError('password', 'Mật Khẩu tối thiểu 6 ký tự, gồm ít nhất 1 chữ cái và 1 chữ số.');
            } 
            return flag;  
        }
        function fileValidation()
        {
            let fileInput = document.getElementById('file');
            let filePath = fileInput.value;//lấy giá trị input theo id
            let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;//các tập tin cho phép
            //Kiểm tra định dạng
            if(!allowedExtensions.exec(filePath))
            {
                alert('Vui lòng upload các file có định dạng: .jpeg/.jpg/.png/.gif only.');
                fileInput.value = '';
                return false;
            }
            else
            {
                //Image preview
                if (fileInput.files && fileInput.files[0])
                {
                    var reader = new FileReader();
                    reader.onload = function(e)
                                    {
                                        document.getElementById('imagePreview').innerHTML = '<img style="width:700px;height:400px;" src="'+e.target.result+'"/>';
                                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
    </script>
</head>
<body>

<div class="container">
<h2>INSERT USER</h2>
<form  class="form-horizontal" enctype = "multipart/form-data" action="insert_user" method= "post" autocomplete ="off">
<div class="form-group">
   <label class="control-label col-sm-2" for="email">Name :</label>
   <div class="col-sm-10">
      <input required="" type="text" class="form-control" id="email" name="name" value = "">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-2" for="email">Email :</label>
   <div class="col-sm-10">
      <input required="" type="email" class="form-control" id="email" name="email" value = "">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-2" for="email">Password :</label>
   <div class="col-sm-10">
      <input type="password" class="form-control" id="pass" name="pass" >
      <span id="password"></span>
      <span id="password_error"></span>
   </div>
   
</div>
<div class="form-group">
     <label class="control-label col-sm-2" for="email" name = "avatar">Avatar :</label>
     <div class="col-sm-10">
        <!-- File input field -->
            <input type="file" id="file" onchange="return fileValidation()" name="userfile" size="20"/>
 <!-- Image preview -->
            <div id="imagePreview"></div>
     </div>
  </div>
<div class="form-group">
  <label class="control-label col-sm-2" for="email">Status	:</label>
  <div class="col-sm-10">
    <input required="" type="" class="form-control" id="email" name="status" value = "">
  </div>
</div>

<div class="form-group">        
  <div class="col-sm-offset-2 col-sm-10" >
    <input style = "background : #007bff" type="submit" name="dangky" value="upload" onclick="return validate()" >
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