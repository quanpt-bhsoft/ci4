<?php $this->extend('layouts/LayoutCart');
$this->section('cart'); ?>

<div class="card">

    <div class="row">

        <div class="col-md-12 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>History Order</b></h4>
                    </div>
                </div>
            </div>
            <?php foreach ($getOrder as $getOrder) :
            ?>
                <div class="row border-top ">
                    <div class="row main align-items-center">
                        <div class="col-4">
                            <img style="width:200px !important ; height :auto !important;" src="<?php
                                                                                                if (strpos($getOrder['Avatar'], 'via') == 8) {
                                                                                                    echo $getOrder['Avatar'];
                                                                                                } else {
                                                                                                    echo "/uploads/" . $getOrder['Avatar'];
                                                                                                }
                                                                                                ?>">
                        </div>
                        <div class="col-2">
                            <div class="row text-muted"><?php echo $getOrder['Name'] ?></div>
                            <div class="row"><?php echo $getOrder['Title'] ?></div>
                        </div>
                        <div class=" row col">
                            <div class="col-8">
                                <?php echo $getOrder['Price'];
                                echo 'VND' ?>
                            </div>
                            <?php
                            if ($getOrder['status'] == 0) {
                                echo 'Under Review';
                            } elseif ($getOrder['status'] == 1) {
                                echo 'Deny';
                            } else {
                                echo 'Accepted';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach
            ?>
            <div>
                <?php echo $pagerHistory->links(); ?>
            </div>
            <div class="back-to-shop row">
                <div class="col-10">
                    <a href="/">&leftarrow;</a>
                    <span class="text-muted">Back to shop</span>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $this->Endsection(); ?>