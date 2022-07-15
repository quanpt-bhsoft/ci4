<?php $this->extend('layouts/LayoutCart');
$this->section('cart'); ?>
<div class="card">
    <div class="row">
        <div class="col-md-12 cart">
            <div class="title">
                <div class="row">
                    <div class="col">
                        <h4><b>Shopping Cart</b></h4>
                    </div>
                </div>
            </div>
            <?php for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                if (isset($_SESSION['cart'][$i])) {
            ?>
                    <div class="row border-top ">
                        <div class="row main align-items-center">
                            <div class="col-4">
                                <img style="width:200px !important ; height :auto !important;" src="<?php
                                                                                                    if (strpos($_SESSION['cart'][$i]['Avatar'], 'via') == 8) {
                                                                                                        echo $_SESSION['cart'][$i]['Avatar'];
                                                                                                    } else {
                                                                                                        echo "/uploads/" . $_SESSION['cart'][$i]['Avatar'];
                                                                                                    }
                                                                                                    ?>">
                            </div>
                            <div class="col-2">
                                <div class="row text-muted"><?php echo $_SESSION['cart'][$i]['Name'] ?></div>
                                <div class="row"><?php echo $_SESSION['cart'][$i]['Title'] ?></div>
                            </div>
                            <div class=" row col">
                                <div class="col-8">
                                    <?php echo $_SESSION['cart'][$i]['Price'];
                                    echo 'VND' ?>
                                </div>
                                <form action="<?php echo base_url('add_order/'.$_SESSION['cart'][$i]['ID']) ?>" method="post">
                                    <button>MUA</button>
                                </form>
                                <form action="<?php echo base_url('delete_cart/' . $_SESSION['cart'][$i]['ID']) ?>" method="post">
                                <input type="text" value="delete" name="_method" hidden>
                                    <button><span class="close">&#10005;</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
            <div class="back-to-shop row">
                <div class="col-10">
                    <a href="/">&leftarrow;</a>
                    <span class="text-muted">Back to shop</span>
                </div>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['Status'] == 0) { ?>
                    <div class="col">
                        <a href="history_order/<?php echo $_SESSION['user']['ID'] ?>"><span class="text-muted">History order</span></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php $this->Endsection(); ?>