<?php $this->extend('layouts/LayoutDetail');
$this->section('detail'); ?>
<div class="to">
    <div class="ca">
        <div class="ca1">
            <h4>Course Information</h4>
        </div>
        <div class="hi">
            <div class="h1">
                <h4>Name : </h4>
                <h4><?php echo $getCourse['Name'] ?></h4>
            </div>
            <div class="h1">
                <h4>Price : </h4>
                <h4><?php echo $getCourse['Price'] ?></h4>
            </div>
            <div class="h1">
                <h4>Title : </h4>
                <h4><?php echo $getCourse['Title'] ?></h4>
            </div>
            <div class="h1">
                <h4>Describe : </h4>
                <h4><?php echo $getCourse['Describe'] ?></h4>
            </div>
            <div class="h2">
                <img class="img-profile rounded-circle" src="<?php
                                                                if (strpos($getCourse['Avatar'], 'via') == 8) {
                                                                    echo $getCourse['Avatar'];
                                                                } else {
                                                                    echo "/uploads/" . $getCourse['Avatar'];
                                                                } ?>" alt="Image">
            </div>
        </div>
    </div>
    <div class="ca2">
        <div class="ca22">
            <h2>LESSON</h2>
        </div>
        <div class="ca22">
            <?php foreach ($getLesson as $getLesson) : ?>
                <div class="h1">
                    <h4>Title : </h4>
                    <h4><?php echo $getLesson['Title'] ?></h4>
                </div>
                <?php if (isset($check['id']) && $check['id'] == 1) {  ?>
                    <div class="h1">
                        <h4>Content : </h4>
                        <h4><?php echo $getLesson['Content'] ?></h4>
                    </div>
                <?php } ?>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php $this->Endsection(); ?>