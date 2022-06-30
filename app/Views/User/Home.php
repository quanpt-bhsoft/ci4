
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/admin/css/main.css" />
    
    <title>Document</title>
  </head>
  <body>
= <div class="user-information-container">
      <div class="header">Thông tin cá nhân</div>
      <?php foreach ($get_user as $get_user): ?>
      <form action="<?php echo $get_user['ID']?>" method = "post" class="info-form" enctype ="multipart/form-data">
        <div class="avatar">
          <div class="input-img">
            <label for="inputImg">
            <div>
            <img  id="avatar" src="<?php  echo "/uploads/".$get_user['Avatar']?>" alt="" />'
           </div>
            </label>
            <input
              id="inputImg"
              name="avatar"
              type="file"
              accept="image/*"
              style="display: none; visibility: hidden"
              onchange="getImg(this.value)"
            />
          </div>
        </div>
        <div class="info">
          <div class="input-wrapper-info">
            <label for="name">Name </label>
            <input type="text" value = "<?php echo $get_user['Name'] ?>" name="name" placeholder="" />
          </div>
          <div class="input-wrapper-info">
            <label for="phone">Email</label>
            <input type="text" value = "<?php echo $get_user['Email'] ?>" name="email" placeholder="" />
          </div>
          <div class="input-wrapper-info">
            <label for="address">Password</label>
            <input type="password" value = "<?php echo $get_user['Password'] ?>" name="pass" placeholder="" />
          </div>
          <button type="submit" class="btn-info">save</button>
        </div>
      </form>
      <?php endforeach ?>
    </div>

    <script>
      function getImg(evt) {
        var tgt = evt.target || window.event.srcElement,
          files = tgt.files;

        if (FileReader && files && files.length) {
          var fr = new FileReader();
          fr.onload = function () {
            document.getElementById("avatar").src = fr.result;
          };
          fr.readAsDataURL(files[0]);
        }
      }
    </script>
  </body>
</html>