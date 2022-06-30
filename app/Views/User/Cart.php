<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/admin/css/cart.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="card">
    
            <div class="row">
                
                <div class="col-md-12 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col"><h4><b>Shopping Cart</b></h4></div>
                        </div>
                    </div>   
                    <?php for($i = 0;$i<count($_SESSION['cart']);$i++)
                        {
                            if(isset($_SESSION['cart'][$i]))
                            { 
                            ?> 
                                <div class="row border-top ">
                                    <div class="row main align-items-center">
                                        <div class="col-4"><img style="width:200px !important ; height :auto !important;" src="/uploads/<?php echo $_SESSION['cart'][$i]['Avatar'] ?>"></div>
                                        <div class="col-2">
                                            <div class="row text-muted"><?php echo $_SESSION['cart'][$i]['Name'] ?></div>
                                            <div class="row"><?php echo $_SESSION['cart'][$i]['Title'] ?></div>
                                        </div>
                                        <div class=" row col">
                                            <div class="col-8">
                                                <?php echo $_SESSION['cart'][$i]['Price']; echo 'VND' ?>
                                            </div>
                                                <a href="add_order/<?php echo $_SESSION['cart'][$i]['ID'] ?>">MUA</a>
                                                <a href="delete_cart/<?php echo $_SESSION['cart'][$i]['ID'] ?>"><span class="close">&#10005;</span></a>
                                            </div>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    <div class="back-to-shop row">
                        <div class = "col-10">
                            <a  href="/">&leftarrow;</a>
                            <span class="text-muted">Back to shop</span>
                        </div>
                        <?php if(isset($_SESSION['user'])){ ?>
                        <div class = "col">
                            <a href="history_order/<?php echo $_SESSION['user']['ID'] ?>"><span class="text-muted">History order</span></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            
        </div>
</body>
</html>