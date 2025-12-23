<?php
/** @var array $imagenesHome */ // <--- AÑADE ESTA LÍNEA
require_once __DIR__ . '/../../templates/inicio.part.php'; 
?>
<?php require_once __DIR__ . '/../../templates/navegacion.part.php'; ?>

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
                require __DIR__ . '/../imagen-index.part.php'; 
            ?>
            <?php 
                $idCategoria = 2;         
                shuffle($imagenesHome);   
                require __DIR__ . '/../imagen-index.part.php'; 
            ?>

            <?php 
                $idCategoria = 3;         
                shuffle($imagenesHome);   
                require __DIR__ . '/../imagen-index.part.php'; 
            ?>

        </div>
        </div><div class="index-form text-center">
        <h3>SUSCRIBE TO OUR NEWSLETTER </h3>
        <h5>Suscribe to receive our News and Gifts</h5>
        <form class="form-horizontal">
            <div class="form-group">
                <div class="col-xs-12 col-sm-6 col-sm-push-3 col-md-4 col-md-push-4">
                    <input class="form-control" type="text" placeholder="Type here your email address">
                    <a href="" class="btn btn-lg sr-button">SUBSCRIBE</a>
                </div>
            </div>
        </form>
    </div>
    
    <div class="last-box row">
        <div class="col-xs-12 col-sm-4 col-sm-push-4 last-block">
            <div class="partner-box text-center">
                <p>
                    <i class="fa fa-map-marker fa-2x sr-icons"></i>
                    <span class="text-muted">35 North Drive, Adroukpape, PY 88105, Agoe Telessou</span>
                </p>
                <h4>Our Main Partners</h4>
                <hr>
                <div class="text-muted text-left">
                    <ul class="list-inline">
                        <li><img src="images/index/log2.jpg" alt="logo"></li>
                        <li>First Partner Name</li>
                    </ul>
                    <ul class="list-inline">
                        <li><img src="images/index/log1.jpg" alt="logo"></li>
                        <li>Second Partner Name</li>
                    </ul>
                    <ul class="list-inline">
                        <li><img src="images/index/log3.jpg" alt="logo"></li>
                        <li>Third Partner Name</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div><?php require_once __DIR__ . '/../../templates/fin.part.php'; ?>