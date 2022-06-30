<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>
    <link rel="stylesheet" href="../admin/css/main.css" />
    <link rel="stylesheet" href="../admin/css/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="../admin/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">

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
                <a class="nav-link" href="show_user">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="show_course">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Course List</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="show_order">
                <i class="fab fa-first-order"></i>
                    <span>Order</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="show_lesson">
                    <i class="fas fa-address-book"></i>
                    <span>Lesson</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout">
                <i style = " -webkit-transform: rotateY(180deg);
                             -moz-transform: rotateY(180deg);
                             -ms-transform: rotateY(180deg);
                             transform: rotateY(180deg) "
                        class="fas fa-sign-out-alt"></i>
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

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action ="#" method ="POST">
                        <div class="input-group">
                            <input name ="haha" type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <!-- Nav Item - Alerts -->


                        <!-- Nav Item - Messages -->
                

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user']['Name'] ?></span>
                                <p><img class="img-profile rounded-circle" src="<?php echo '../uploads/'.$_SESSION['user']['Avatar'] ?>"alt="Image">'</p>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
<?php if(isset($getuser))
        { ?>
                <!-- Begin Page Content -->
                <div style =" display: flex;flex-direction: column; align-items: center;">
                    <div style = "margin-top : 3%;margin-bottom:3%"><H1>User</H1></div>
                    <div class = "haaa"><button><a href="insert_user">ADD</a></button></div>
                    <div class = "xem">
                        <table class="table ha" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th> 
                                    <th>Email</th>
                                    <th>Course</th>
                                    <th>Avatar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($getuser as $getuser): ?>
                                <tr>
                                    <td><?php echo $getuser['ID'] ?></td>
                                    <td><?php echo $getuser['Name'] ?></td>
                                    <td><?php echo $getuser['Email'] ?></td>
                                    <td>
                                    <?php $dem = 0;
                                    for($i = 0;$i<(count($getuser)-6);$i++){
                                        if(isset($getuser[$dem])){
                                            echo $getuser["$i"];?><br><?php
                                        }
                                    }
                                        ?>
                                    </td>
                                    <td><img style = "width:7em; height : 7em;" src="<?php  echo "../uploads/".$getuser['Avatar']; ?>"alt="Image"></td>
                                    <td>
                                        <div style = "display: flex; justify-content:space-between; width: 100px ;">
                                            <a href="<?php echo site_url('update_user/'.$getuser['ID']); ?>">
                                                <i class="fas fa-wrench"></i>
                                            </a>
                                            <a href="<?php echo site_url('delete_user/'.$getuser['ID']); ?>" onclick = "return confirm('Are you sure want to delete?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                        
                    </div>
                <!-- /.container-fluid -->
                </div>
     <?php }
            elseif(isset($get_course)){ ?>
            <!-- course  -->
            <div style =" display: flex;flex-direction: column; align-items: center;">
                    <div style = "margin-top : 3%;margin-bottom:3%"><H1>Course</H1></div>
                    <div class = "haaa"><button><a href="insert_course">ADD</a></button></div>
                    <div class = "xem">
                        <table class="table ha" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th> 
                                    <th>Price</th>
                                    <th>Avatar</th>
                                    <th>Titel</th>
                                    <th>Describe</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($get_course as $get_course): ?>
                                <tr>
                                    <td><?php echo $get_course['ID'] ?></td>
                                    <td><?php echo $get_course['Name'] ?></td>
                                    <td><?php echo $get_course['Price'] ?>VND</td>
                                    <td><img style = "width:7em; height : 7em;" src="<?php  echo "../uploads/".$get_course['Avatar']; ?>"alt="Image"></td>
                                    <td><?php echo $get_course['Title'] ?></td>
                                    <td style="width :200px ; height: 200px;"><?php echo $get_course['Describe'] ?></td>
                                    <td>
                                        <div style = "display: flex; justify-content:space-between; width: 100px ;">
                                            <a href="<?php echo site_url('update_course/'.$get_course['ID']); ?>">
                                                <i class="fas fa-wrench"></i>
                                            </a>
                                            <a href="<?php echo site_url('delete_course/'.$get_course['ID']); ?>" onclick = "return confirm('Are you sure want to delete?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                        
                    </div>
                <!-- /.container-fluid -->
                </div>
                <?php }
                elseif(isset($get_lesson)){ ?>
                    <!-- course  -->
                    <div style =" display: flex;flex-direction: column; align-items: center;">
                            <div style = "margin-top : 3%;margin-bottom:3%"><H1>Lesson</H1></div>
                            <div class = "haaa"><button><a href="insert_lesson">ADD</a></button></div>
                            <div class = "xem">
                                <table class="table ha" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th> 
                                            <th>Content</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($get_lesson as $get_lesson): ?>
                                        <tr>
                                            <td><?php echo $get_lesson['ID'] ?></td>
                                            <td><?php echo $get_lesson['Title'] ?></td>
                                            <td><?php echo $get_lesson['Content'] ?></td>
                                            <td><?php echo $get_lesson['Name'] ?></td>
                                            <td>
                                                <div style = "display: flex; justify-content:space-between; width: 100px ;">
                                                    <a href="<?php echo site_url('update_lesson/'.$get_lesson['ID']); ?>">
                                                        <i class="fas fa-wrench"></i>
                                                    </a>
                                                    <a href="<?php echo site_url('delete_lesson/'.$get_lesson['ID']); ?>" onclick = "return confirm('Are you sure want to delete?');">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                                
                            </div>
                        <!-- /.container-fluid -->
                        </div>
                        <?php }
                else { ?>
                <div style =" display: flex;flex-direction: column; align-items: center;">
                    <div style = "margin-top : 3%;margin-bottom:3%"><H1>ORDER</H1></div>
                    <div class = "xem">
                    <div class="quanLyTin" id="quanLyTin">
                        <div class="quanLy_item active" id="inProgress" onclick="change1()">
                            <p>Đợi Xét Duyệt</p>
                        </div>
                        <div class="quanLy_item" id="cancel" onclick="change2()">
                            <p>Bị từ chối</p>
                        </div>
                        <div class="quanLy_item" id="done" onclick="change3()">
                            <p>Đã Chấp Nhận</p>
                        </div>
                    </div>
                    <!-- dang xet duyet  -->
                    <div id="listInProgress">
                        <table class="table ha" >
                            <thead>
                                <tr>
                                    <th>Buyer ID</th>
                                    <th>Buyer Name</th> 
                                    <th>Course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($get_order_new as $get_order_new): ?>
                                <tr>
                                    <td><?php echo $get_order_new['iduser'] ?></td>
                                    <td><?php echo $get_order_new['username'] ?></td>
                                    <td><?php echo $get_order_new['Name'] ?></td>
                                    <td>
                                        <div style = "display: flex; justify-content:space-between; width: 100px ;">
                                            <div class="check">
                                                <button class="accept"><a onclick = "return confirm('Are you sure want to accept?');" href="accept_order/<?php echo $get_order_new['ID'] ?>">Duyệt</a></button>
                                                <button type="submit" class="refuse"><a onclick = "return confirm('Are you sure want to deny?');" href="deny_order/<?php echo $get_order_new['ID'] ?>">Từ chối</a></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="listCancel">
                        <table class="table ha" >
                            <thead>
                                <tr>
                                    <th>Buyer ID</th>
                                    <th>Buyer Name</th> 
                                    <th>Course</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($get_order_deny as $get_order_deny): ?>
                                <tr>
                                    <td><?php echo $get_order_deny['iduser'] ?></td>
                                    <td><?php echo $get_order_deny['username'] ?></td>
                                    <td><?php echo $get_order_deny['Name'] ?></td>
                                    <td>
                                        <div style = "display: flex; justify-content:space-between; width: 100px ;">
                                            <div class="check">
                                                DENY
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="listDone">
                        <table class="table ha" >
                            <thead>
                                <tr>
                                    <th>Buyer ID</th>
                                    <th>Buyer Name</th> 
                                    <th>Course</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($get_order_accept as $get_order_accept): ?>
                                <tr>
                                    <td><?php echo $get_order_accept['iduser'] ?></td>
                                    <td><?php echo $get_order_accept['username'] ?></td>
                                    <td><?php echo $get_order_accept['Name'] ?></td>
                                    <td>
                                        <div style = "display: flex; justify-content:space-between; width: 100px ;">
                                            <div class="check">
                                                ACCEPT
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                      
                </div>
                <!-- /.container-fluid -->
                </div>
                <?php }
                 ?>

            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
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
      var current = document.getElementsByClassName("active");
      current[0].className = current[0].className.replace(" active", "");
      this.className += " active";
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src=<?php echo base_url('js/sb-admin-2.min.js')?>></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src=<?php echo base_url('js/demo/chart-area-demo.js')?>></script>
    <script src=<?php echo base_url('js/demo/chart-pie-demo.js')?>></script>

</body>

</html>