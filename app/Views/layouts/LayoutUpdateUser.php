<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url('/admin/css/main.css')?>" />
    <title>Document</title>
</head>

<body>
    <?php $this->renderSection('update'); ?>
    <script>
        function getImg(evt) {
            var tgt = evt.target || window.event.srcElement,
                files = tgt.files;

            if (FileReader && files && files.length) {
                var fr = new FileReader();
                fr.onload = function() {
                    document.getElementById("avatar").src = fr.result;
                };
                fr.readAsDataURL(files[0]);
            }
        }
    </script>
</body>

</html>