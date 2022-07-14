<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('/admin/css/main.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('/admin/css/sb-admin-2.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin <sup>2</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="showUser">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showCourse">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Course List</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showOrder">
                    <i class="fab fa-first-order"></i>
                    <span>Order</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="showLesson">
                    <i class="fas fa-address-book"></i>
                    <span>Lesson</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout">
                    <i style=" -webkit-transform: rotateY(180deg);
                             -moz-transform: rotateY(180deg);
                             -ms-transform: rotateY(180deg);
                             transform: rotateY(180deg) " class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="#" method="POST">
                        <div class="input-group">
                            <input name="haha" type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo session('user')['Name'] ?></span>
                                <p><img class="img-profile rounded-circle" src="<?php echo '../uploads/' . session('user')['Avatar'] ?>" alt="Image">'</p>
                            </a>
                        </li>
                    </ul>

                </nav>
                <?php $this->renderSection('content') ?>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <script>
            var quanLyTin = document.getElementById("quanLyTin");
            console.log(quanLyTin)
            var quanLy_items = quanLyTin.getElementsByClassName("quanLy_item");
            console.log(quanLy_items)
            for (var i = 0; i < quanLy_items.length; i++) {
                quanLy_items[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("actived");
                    current[0].className = current[0].className.replace(" actived", "");
                    this.className += " actived";
                });
            }

            function change1() {
                document.getElementById("listInProgress").style.display = "block"
                document.getElementById("listCancel").style.display = "none"
                document.getElementById("listDone").style.display = "none"
            }

            function change2() {
                document.getElementById("listInProgress").style.display = "none"
                document.getElementById("listCancel").style.display = "block"
                document.getElementById("listDone").style.display = "none"
            }

            function change3() {
                document.getElementById("listInProgress").style.display = "none"
                document.getElementById("listCancel").style.display = "none"
                document.getElementById("listDone").style.display = "block"
            }
        </script>
</body>

</html>