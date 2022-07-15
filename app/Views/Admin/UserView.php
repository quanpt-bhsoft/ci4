<?php $this->extend('layouts/LayoutAdmin');
$this->section('content');
?>
<!-- End of Topbar -->
<?php if (isset($getUser)) { ?>
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
                    <?php foreach ($getUser as $getUser) : ?>
                        <tr>
                            <td><?php echo $getUser['ID'] ?></td>
                            <td><?php echo $getUser['Name'] ?></td>
                            <td><?php echo $getUser['Email'] ?></td>
                            <td>
                                <?php $dem = 0;
                                for ($i = 0; $i < (count($getUser) - 6); $i++) {
                                    if (isset($getUser[$dem])) {
                                        echo $getUser["$i"]; ?><br><?php
                                                                }
                                                            }
                                                                    ?>
                            </td>
                            <td><img style="width:7em; height : 7em;" src="<?php
                                                                            //echo strpos($getUser['Avatar'], 'https:')
                                                                            if (strpos($getUser['Avatar'], 'via') == 8) {
                                                                                echo $getUser['Avatar'];
                                                                            } else {
                                                                                echo "../uploads/" . $getUser['Avatar'];
                                                                            } ?>" alt="Image">
                            </td>
                            <td>
                                <div style="display: flex; justify-content:space-between; width: 100px ;">
                                    <a href="<?php echo site_url('show_update_user/' . $getUser['ID']); ?>">
                                        <i class="fas fa-wrench"></i>
                                    </a>
                                    <form action="<?php echo base_url('delete_user/' . $getUser['ID']); ?>" method="post">
                                        <input type="text" name="_method" value="delete" hidden>
                                        <button style="color: #007bff;border:0px;" type="submit" onclick="return confirm('Are you sure want to delete?');"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
        <!-- /.container-fluid -->
        <div>
            <?php echo $pager->links(); ?>
        </div>
    </div>
<?php } elseif (isset($getCourse)) { ?>
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
                    <?php foreach ($getCourse as $getCourse) : ?>
                        <tr>
                            <td><?php echo $getCourse['ID'] ?></td>
                            <td><?php echo $getCourse['Name'] ?></td>
                            <td><?php echo $getCourse['Price'] ?>VND</td>
                            <td><img style="width:7em; height : 7em;" src="<?php
                                                                            if (strpos($getCourse['Avatar'], 'via') == 8) {
                                                                                echo $getCourse['Avatar'];
                                                                            } else {
                                                                                echo "../uploads/" . $getCourse['Avatar'];
                                                                            } ?>" alt="Image"></td>
                            <td><?php echo $getCourse['Title'] ?></td>
                            <td style="width :200px ; height: 200px;"><?php echo $getCourse['Describe'] ?></td>
                            <td>
                                <div style="display: flex; justify-content:space-between; width: 100px ;">
                                    <a href="<?php echo site_url('show_update_course/' . $getCourse['ID']); ?>">
                                        <i class="fas fa-wrench"></i>
                                    </a>
                                    <form action="<?php echo base_url('delete_course/' . $getCourse['ID']); ?>" method="post">
                                        <input type="text" name="_method" value="delete" hidden>
                                        <button style="color: #007bff;border:0px;" type="submit" onclick="return confirm('Are you sure want to delete?');"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
        <div>
            <?php echo $pager->links(); ?>
        </div>
        <!-- /.container-fluid -->
    </div>
<?php } elseif (isset($getLesson)) { ?>
    <!-- course  -->
    <div style=" display: flex;flex-direction: column; align-items: center;">
        <div style="margin-top : 3%;margin-bottom:3%">
            <H1>Lesson</H1>
        </div>
        <div class="haaa"><button><a href="show_insert_lesson">ADD</a></button></div>
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
                    <?php foreach ($getLesson as $getLesson) : ?>
                        <tr>
                            <td><?php echo $getLesson['ID'] ?></td>
                            <td><?php echo $getLesson['Title'] ?></td>
                            <td><?php echo $getLesson['Content'] ?></td>
                            <td><?php echo $getLesson['Name'] ?></td>
                            <td>
                                <div style="display: flex; justify-content:space-between; width: 100px ;">
                                    <a href="<?php echo site_url('show_update_lesson/' . $getLesson['ID']); ?>">
                                        <i class="fas fa-wrench"></i>
                                    </a>
                                    <form action="<?php echo base_url('delete_lesson/' . $getLesson['ID']); ?>" method="post">
                                        <input type="text" name="_method" value="delete" hidden>
                                        <button style="color: #007bff;border:0px;" type="submit" onclick="return confirm('Are you sure want to delete?');"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

        </div>
        <!-- /.container-fluid -->
        <div>
            <?php echo $pager->links(); ?>
        </div>
    </div>

<?php } else { ?>
    <div style=" display: flex;flex-direction: column; align-items: center;">
        <div style="margin-top : 3%;margin-bottom:3%">
            <H1>ORDER</H1>
        </div>
        <div class="xem">
            <div class="quanLyTin" id="quanLyTin">
                <div class="quanLy_item actived" id="inProgress" onclick="change1()">
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
                        <?php foreach ($getOrderNew as $getOrderNew) : ?>
                            <tr>
                                <td><?php echo $getOrderNew['iduser'] ?></td>
                                <td><?php echo $getOrderNew['username'] ?></td>
                                <td><?php echo $getOrderNew['Name'] ?></td>
                                <td>
                                    <div style="display: flex; justify-content:space-between; width: 100px ;">
                                        <div class="check">
                                            <form action="<?php echo base_url('accept_order/' . $getOrderNew['ID']); ?>" method="post">
                                                <input type="text" name="_method" value="put" hidden>
                                                <button class="accept" onclick="return confirm('Are you sure want to accept?')">Duyệt</button>
                                            </form>
                                            <form action="<?php echo base_url('deny_order/' . $getOrderNew['ID']); ?>" method="post">
                                                <input type="text" name="_method" value="put" hidden>
                                                <button type="submit" class="refuse" onclick="return confirm('Are you sure want to deny?');">Từ chối</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div>
                    <?php echo $pagerNew->links(); ?>
                </div>
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
                        <?php foreach ($getOrderDeny as $getOrderDeny) : ?>
                            <tr>
                                <td><?php echo $getOrderDeny['iduser'] ?></td>
                                <td><?php echo $getOrderDeny['username'] ?></td>
                                <td><?php echo $getOrderDeny['Name'] ?></td>
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
                <div>
                    <?php echo $pagerDeny->links(); ?>
                </div>
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
                        <?php foreach ($getOrderAccept as $getOrderAccept) : ?>
                            <tr>
                                <td><?php echo $getOrderAccept['iduser'] ?></td>
                                <td><?php echo $getOrderAccept['username'] ?></td>
                                <td><?php echo $getOrderAccept['Name'] ?></td>
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
                <div>
                    <?php echo $pagerAccept->links(); ?>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
<?php };
$this->Endsection();
?>