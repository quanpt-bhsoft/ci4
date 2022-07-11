<?php $this->extend('layouts/LayoutUpdateUser');
$this->section('update'); ?>
<div class="user-information-container">
  <div class="header">Thông tin cá nhân</div>
  <form action="<?php echo $get_user['ID'] ?>" method="post" class="info-form" enctype="multipart/form-data">
    <div class="avatar">
      <div class="input-img">
        <label for="inputImg">
          <div>
            <img id="avatar" src="<?php echo "/uploads/" . $get_user['Avatar'] ?>" alt="" />'
          </div>
        </label>
        <input id="inputImg" name="avatar" type="file" accept="image/*" style="display: none; visibility: hidden" onchange="getImg(this.value)" />
      </div>
    </div>
    <div class="info">
      <div class="input-wrapper-info">
        <label for="name">Name </label>
        <input type="text" value="<?php echo $get_user['Name'] ?>" name="name" placeholder="" />
      </div>
      <div class="input-wrapper-info">
        <label for="phone">Email</label>
        <input type="text" value="<?php echo $get_user['Email'] ?>" name="email" placeholder="" />
      </div>
      <div class="input-wrapper-info">
        <label for="address">Password</label>
        <input type="password" value="<?php echo $get_user['Password'] ?>" name="pass" placeholder="" />
      </div>
      <button type="submit" class="btn-info">save</button>
    </div>
  </form>
</div>
<?php $this->Endsection(); ?>