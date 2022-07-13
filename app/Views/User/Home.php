<?php $this->extend('layouts/LayoutUpdateUser');
$this->section('update'); ?>
<div class="user-information-container">
  <div class="header">Thông tin cá nhân</div>
  <form action="<?php echo $getUser['ID'] ?>" method="post" class="info-form" enctype="multipart/form-data">
    <div class="avatar">
      <div class="input-img">
        <label for="inputImg">
          <div>
            <img id="avatar" src="<?php
                                  if (strpos($getUser['Avatar'], 'via') == 8) {
                                    echo $getUser['Avatar'];
                                  } else {
                                    echo "/uploads/" . $getUser['Avatar'];
                                  }
                                  ?>" alt="" />'
          </div>
        </label>
        <input id="inputImg" name="avatar" type="file" accept="image/*" style="display: none; visibility: hidden" onchange="getImg(this.value)" />
      </div>
    </div>
    <div class="info">
      <div class="input-wrapper-info">
        <label for="name">Name </label>
        <input type="text" value="<?php echo $getUser['Name'] ?>" name="name" placeholder="" />
      </div>
      <div class="input-wrapper-info">
        <label for="phone">Email</label>
        <input type="text" value="<?php echo $getUser['Email'] ?>" name="email" placeholder="" />
      </div>
      <div class="input-wrapper-info">
        <label for="address">Password</label>
        <input type="password" value="<?php echo $getUser['Password'] ?>" name="pass" placeholder="" />
      </div>
      <button type="submit" class="btn-info">save</button>
    </div>
  </form>
</div>
<?php $this->Endsection(); ?>