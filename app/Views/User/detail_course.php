<?php if(isset($get_course[0]['0']))
{
$check = $get_course[0]['0'];
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/admin/css/user.css">
</head>
<body>
<div class = "to">
    <div class = "ca">
        <div class ="ca1">
            <h4>Course Information</h4>
        </div>
        <?php foreach($get_course as $get_course): ?>
        <div class = "hi">
            <div class = "h1"><h4>Name  : </h4> <h4><?php echo $get_course['Name']?></h4></div>  
            <div class ="h1"><h4>Price : </h4> <h4><?php echo $get_course['Price']?></h4></div>
            <div class ="h1"><h4>Title : </h4> <h4><?php echo $get_course['Title']?></h4></div>
            <div class ="h1"><h4>Describe : </h4> <h4><?php echo $get_course['Describe']?></h4></div>
            <div class = "h2">
            <img class="img-profile rounded-circle" src="/uploads/<?php echo $get_course['Avatar'] ?>" alt="Image">
            </div>
        </div>
        <?php endforeach ?>
    </div>
    <div class ="ca2">
        <div class = "ca22">
            <h2>LESSON</h2>
        </div>
        <div class = "ca22">
            <?php foreach($get_lesson as $get_lesson): ?>
            <div class = "h1"><h4>Title  : </h4> <h4><?php echo $get_lesson['Title']?></h4></div>
            <?php if (isset($check)&&$check == 1){  ?>  
            <div class = "h1"><h4>Content : </h4> <h4><?php echo $get_lesson['Content']?></h4></div>
            <?php } ?>
            <?php  endforeach ?>
        </div>
    </div>
</div>
</body>
</html>