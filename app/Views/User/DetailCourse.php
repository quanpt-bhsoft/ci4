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
                <h4><?php echo $get_course['Name'] ?></h4>
            </div>
            <div class="h1">
                <h4>Price : </h4>
                <h4><?php echo $get_course['Price'] ?></h4>
            </div>
            <div class="h1">
                <h4>Title : </h4>
                <h4><?php echo $get_course['Title'] ?></h4>
            </div>
            <div class="h1">
                <h4>Describe : </h4>
                <h4><?php echo $get_course['Describe'] ?></h4>
            </div>
            <div class="h2">
                <img class="img-profile rounded-circle" src="/uploads/<?php echo $get_course['Avatar'] ?>" alt="Image">
            </div>
        </div>
    </div>
    <div class="ca2">
        <div class="ca22">
            <h2>LESSON</h2>
        </div>
        <div class="ca22">
            <?php foreach ($get_lesson as $get_lesson) : ?>
                <div class="h1">
                    <h4>Title : </h4>
                    <h4><?php echo $get_lesson['Title'] ?></h4>
                </div>
                <?php if (isset($check[0]['id']) && $check[0]['id'] == 1) {  ?>
                    <div class="h1">
                        <h4>Content : </h4>
                        <h4><?php echo $get_lesson['Content'] ?></h4>
                    </div>
                <?php } ?>
            <?php endforeach ?>
        </div>
    </div>
</div>
<?php $this->Endsection(); ?>