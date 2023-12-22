<?php
    function display_product ($conn){
        $sql = "select * from product";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $products = $statement->fetchAll();
        foreach ($products as $product){
            echo '
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <a class="product_item" href="">
                    <div class="product_img" style="background-image: url(./admin/'.$product['image1'].');"></div>
                    <hr>
                    <h5 class="name_product">'.$product['name'].'</h5>
                    <p class="price_product">'.$product['price'].' Đ</p>
                    <p class="price_product">Số lượng: '.$product['quantity'].'</p>
                </a>
            </div>
            ';
        }
    }
?>
<div id="home">
    <div class="container">
        <div class="row">
            <?php display_product($conn) ?>
        </div>
    </div>
</div>