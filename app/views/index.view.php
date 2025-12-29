<?php
/** @var array $imagenesHome */ 
?>

<div id="index">

    <div class="row">
        <div class="col-xs-12 intro">
            <div class="carousel-inner">
                <div class="item active">
                    <img class="img-responsive" src="/public/images/index/woman.jpg" alt="header picture">
                </div>
                <div class="carousel-caption">
                    <h1>FIND NICE PICTURES HERE</h1>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <div id="index-body">
        <div class="table-responsive">
            <table class="table text-center">
                <thead>
                    <tr>
                        <td><a class="link active" href="#category1" data-toggle="tab">category I</a></td>
                        <td><a class="link" href="#category2" data-toggle="tab">category II</a></td>
                        <td><a class="link" href="#category3" data-toggle="tab">category III</a></td>
                    </tr>
                </thead>
            </table>
            <hr>
        </div>

        <div class="tab-content">
            <?php 
                $idCategoria = 1;         
                shuffle($imagenesHome);   
                require __DIR__ . '/imagen-index.part.php'; 
            ?>
            <?php 
                $idCategoria = 2;         
                shuffle($imagenesHome);   
                require __DIR__ . '/imagen-index.part.php'; 
            ?>
            <?php 
                $idCategoria = 3;         
                shuffle($imagenesHome);   
                require __DIR__ . '/imagen-index.part.php'; 
            ?>
        </div>
    </div>

    <div class="index-form text-center">
        <h3>SUBSCRIBE TO OUR NEWSLETTER </h3>
        <h5>Subscribe to receive our News and Gifts</h5>
        <form class="form-horizontal" action="#" method="POST">
            <div class="form-group">
                <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4">
                    <input class="form-control" type="text" name="email" placeholder="Type here your email address">
                    <button type="submit" class="btn btn-lg sr-button" style="margin-top: 10px;">SUBSCRIBE</button>
                </div>
            </div>
        </form>
    </div>
    
    <?php require_once __DIR__ . '/indexlogos.view.part.php'; ?>

</div>