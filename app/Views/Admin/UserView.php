<?php $this->extend('layouts/LayoutAdmin');
$this->section('content');
?>
<!-- End of Topbar -->
<?php if (isset($getuser)) { ?>
    <!-- Begin Page Content -->
    <div style=" display: flex;flex-direction: column; align-items: center;">
        <div style="margin-top : 3%;margin-bottom:3%">
            <H1>User</H1>
        </div>
        <div class="haaa"><button><a href="show_insert_user">ADD</a></button></div>
        <div class="xem">
            <table class="table ha">
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
                    <?php foreach ($getuser as $getuser) : ?>
                        <tr>
                            <td><?php echo $getuser['ID'] ?></td>
                            <td><?php echo $getuser['Name'] ?></td>
                            <td><?php echo $getuser['Email'] ?></td>
                            <td>
                                <?php $dem = 0;
                                for ($i = 0; $i < (count($getuser) - 6); $i++) {
                                    if (isset($getuser[$dem])) {
                                        echo $getuser["$i"]; ?><br><?php
                                                                }
                                                            }
                                                                    ?>
                            </td>
                            <td><img style="width:7em; height : 7em;" src="<?php echo "../uploads/" . $getuser['Avatar']; ?>" alt="Image"></td>
                            <td>
                                <div style="display: flex; justify-content:space-between; width: 100px ;">
                                    <a href="<?php echo site_url('update_user/' . $getuser['ID']); ?>">
                                        <i class="fas fa-wrench"></i>
                                    </a>
                                    <a href="<?php echo site_url('delete_user/' . $getuser['ID']); ?>" onclick="return confirm('Are you sure want to delete?');">
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
<?php } elseif (isset($get_course)) { ?>
    <!-- course  -->
    <div style=" display: flex;flex-direction: column; align-items: center;">
        <div style="margin-top : 3%;margin-bottom:3%">
            <H1>Course</H1>
        </div>
        <div class="haaa"><button><a href="show_insert_course">ADD</a></button></div>
        <div class="xem">
            <table class="table ha">
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
                    <?php foreach ($get_course as $get_course) : ?>
                        <tr>
                            <td><?php echo $get_course['ID'] ?></td>
                            <td><?php echo $get_course['Name'] ?></td>
                            <td><?php echo $get_course['Price'] ?>VND</td>
                            <td><img style="width:7em; height : 7em;" src="<?php echo "../uploads/" . $get_course['Avatar']; ?>" alt="Image"></td>
                            <td><?php echo $get_course['Title'] ?></td>
                            <td style="width :200px ; height: 200px;"><?php echo $get_course['Describe'] ?></td>
                            <td>
                                <div style="display: flex; justify-content:space-between; width: 100px ;">
                                    <a href="<?php echo site_url('update_course/' . $get_course['ID']); ?>">
                                        <i class="fas fa-wrench"></i>
                                    </a>
                                    <a href="<?php echo site_url('delete_course/' . $get_course['ID']); ?>" onclick="return confirm('Are you sure want to delete?');">
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
<?php } elseif (isset($get_lesson)) { ?>
    <!-- course  -->
    <div style=" display: flex;flex-direction: column; align-items: center;">
        <div style="margin-top : 3%;margin-bottom:3%">
            <H1>Lesson</H1>
        </div>
        <div class="haaa"><button><a href="insert_lesson">ADD</a></button></div>
        <div class="xem">
            <table class="table ha">
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
                    <?php foreach ($get_lesson as $get_lesson) : ?>
                        <tr>
                            <td><?php echo $get_lesson['ID'] ?></td>
                            <td><?php echo $get_lesson['Title'] ?></td>
                            <td><?php echo $get_lesson['Content'] ?></td>
                            <td><?php echo $get_lesson['Name'] ?></td>
                            <td>
                                <div style="display: flex; justify-content:space-between; width: 100px ;">
                                    <a href="<?php echo site_url('update_lesson/' . $get_lesson['ID']); ?>">
                                        <i class="fas fa-wrench"></i>
                                    </a>
                                    <a href="<?php echo site_url('delete_lesson/' . $get_lesson['ID']); ?>" onclick="return confirm('Are you sure want to delete?');">
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
<?php } else { ?>
    <div style=" display: flex;flex-direction: column; align-items: center;">
        <div style="margin-top : 3%;margin-bottom:3%">
            <H1>ORDER</H1>
        </div>
        <div class="xem">
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
                <table class="table ha">
                    <thead>
                        <tr>
                            <th>Buyer ID</th>
                            <th>Buyer Name</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($get_order_new as $get_order_new) : ?>
                            <tr>
                                <td><?php echo $get_order_new['iduser'] ?></td>
                                <td><?php echo $get_order_new['username'] ?></td>
                                <td><?php echo $get_order_new['Name'] ?></td>
                                <td>
                                    <div style="display: flex; justify-content:space-between; width: 100px ;">
                                        <div class="check">
                                            <button class="accept"><a onclick="return confirm('Are you sure want to accept?');" href="accept_order/<?php echo $get_order_new['ID'] ?>">Duyệt</a></button>
                                            <button type="submit" class="refuse"><a onclick="return confirm('Are you sure want to deny?');" href="deny_order/<?php echo $get_order_new['ID'] ?>">Từ chối</a></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div id="listCancel">
                <table class="table ha">
                    <thead>
                        <tr>
                            <th>Buyer ID</th>
                            <th>Buyer Name</th>
                            <th>Course</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($get_order_deny as $get_order_deny) : ?>
                            <tr>
                                <td><?php echo $get_order_deny['iduser'] ?></td>
                                <td><?php echo $get_order_deny['username'] ?></td>
                                <td><?php echo $get_order_deny['Name'] ?></td>
                                <td>
                                    <div style="display: flex; justify-content:space-between; width: 100px ;">
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
                <table class="table ha">
                    <thead>
                        <tr>
                            <th>Buyer ID</th>
                            <th>Buyer Name</th>
                            <th>Course</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($get_order_accept as $get_order_accept) : ?>
                            <tr>
                                <td><?php echo $get_order_accept['iduser'] ?></td>
                                <td><?php echo $get_order_accept['username'] ?></td>
                                <td><?php echo $get_order_accept['Name'] ?></td>
                                <td>
                                    <div style="display: flex; justify-content:space-between; width: 100px ;">
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
<?php };
$this->Endsection();
?>