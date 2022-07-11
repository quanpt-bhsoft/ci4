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
    function getValue(id) {
      return document.getElementById(id).value.trim();
    }

    // Hiển thị lỗi
    function showError(key, mess) {
      document.getElementById(`${key}_error`).innerHTML = mess;
    }

    function validate() {

      let flag = true;
      let password = getValue('pass');
      let regex_string = /\D/;
      let regex_number = /\d/;
      let check_string = password.match(regex_string);
      let check_number = password.match(regex_number);
      if (password.length < 6 || regex_string == null || regex_number == null) {
        flag = false;
        showError('password', 'Mật Khẩu tối thiểu 6 ký tự, gồm ít nhất 1 chữ cái và 1 chữ số.');
      }
      return flag;
    }

    function fileValidation() {
      let fileInput = document.getElementById('file');
      let filePath = fileInput.value; //lấy giá trị input theo id
      let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.jfif)$/i; //các tập tin cho phép
      //Kiểm tra định dạng
      if (!allowedExtensions.exec(filePath)) {
        alert('Vui lòng upload các file có định dạng: .jpeg/.jpg/.png/.gif only.');
        fileInput.value = '';
        return false;
      } else {
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            document.getElementById('imagePreview').innerHTML = 'src="' + e.target.result + '"';
          };
          reader.readAsDataURL(fileInput.files[0]);
        }
      }
    }
  </script>
</head>

<body>
  <?php $this->rendersection('content') ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>