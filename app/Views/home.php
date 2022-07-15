<?php
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$this->extend('layouts/LayoutHome.php');
$this->section('Home');
?>
<!-- ? Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="../assets/img/logo/loder.png" alt="">
            </div>
        </div>
    </div>
</div>
<!-- Preloader Start -->
<!-- Header Start -->
<div class="header-area header-transparent">
    <div class="main-header ">
        <div class="header-bottom  header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="index.html"><img src="../assets/img/logo/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10">
                        <div class="menu-wrapper d-flex align-items-center justify-content-end">
                            <!-- Main-menu -->
                            <div class="main-menu d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <!-- Button -->
                                        <li class="button-header margin-left "><a href="cart" style="align-items :center !important; height: 20px !important ;" class="btn btn3"><i class="fas fa-shopping-cart"></i></a></li>
                                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['Status'] == 0) {
                                        ?>
                                            <li class="button-header"><a href="show_update_user1/<?php echo $_SESSION['user']['ID'] ?>" class="btn btn3"><?php echo $_SESSION['user']['Name'] ?></a></li>
                                            <li class="button-header"><a href="logout1" class="btn btn3">Logout</a></li>
                                        <?php
                                        } else {
                                            echo '<li class="button-header"><a href="login" class="btn btn3">Log in</a></li>';
                                        } ?>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->
<!--? slider Area Start-->
<section class="slider-area slider-area2">
    <div class="slider-active">
        <!-- Single Slider -->
        <div class="single-slider slider-height2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-11 col-md-12">
                        <div class="hero__caption hero__caption2">
                            <h1 data-animation="bounceIn" data-delay="0.2s">Our courses</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Courses area start -->
<div class="courses-area section-padding40 fix">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8">
                <div class="section-tittle text-center mb-55">
                    <h2>Our featured courses</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($getCourse as $getCourse) : ?>
                <div class="col-lg-4">
                    <div class="properties properties2 mb-30">
                        <div class="properties__card">
                            <div class="properties__img overlay1">
                                <a href="detail_course/<?php echo $getCourse['ID'] ?>">
                                    <img src="<?php
                                                if (strpos($getCourse['Avatar'], 'via') == 8) {
                                                    echo $getCourse['Avatar'];
                                                } else {
                                                    echo "../uploads/" . $getCourse['Avatar'];
                                                } ?>" alt="">
                                </a>
                            </div>
                            <div class="properties__caption">
                                <h3><a href="detail_course/<?php echo $getCourse['ID'] ?>"><?php echo $getCourse['Name'] ?></a></h3>
                                <p><?php echo $getCourse['Title']  ?>
                                </p>
                                <div class="properties__footer d-flex justify-content-between align-items-center">
                                    <div class="price">
                                        <span><?php echo $getCourse['Price'] ?>VND</span>
                                    </div>
                                </div>
                                <div style="display:flex">
                                    <?php if (isset($getCourse['0']) && $getCourse['0'] == 1) {
                                    ?>
                                        <a href="#" class="border-btn"><span>Already Paid</span></a>
                                    <?php
                                    } else {
                                    ?>
                                        <form action="<?php echo base_url('add_cart/' . $getCourse['ID']) ?>" method="post">
                                            <button class="border-btn"><i class="fas fa-shopping-cart"></i></button>
                                        </form>
                                    <?php
                                    }
                                    ?>
                                    <a href="detail_course/<?php echo $getCourse['ID'] ?>" class="border-btn ">See  Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <?php echo $pager->links(); ?>
    </div>
</div>
<!-- Courses area End -->
<?php $this->Endsection(); ?>