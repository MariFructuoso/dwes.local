<?php
use dwes\app\utils\Utils;
?>

<nav class="navbar navbar-fixed-top navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand page-scroll" href="/">
        <span>[PHOTO]</span>
      </a>
    </div>
    
    <div class="collapse navbar-collapse navbar-right" id="menu">
      <ul class="nav navbar-nav navbar-right">
        <li class="<?= Utils::esOpcionMenuActiva('/') ? 'active' : '' ?> lien">
          <a href="/"><i class="fa fa-home sr-icons"></i> Home</a>
        </li>
        <li class="<?= Utils::esOpcionMenuActiva('/about') ? 'active' : '' ?> lien">
          <a href="/about"><i class="fa fa-bookmark sr-icons"></i> About</a>
        </li>
        <li class="<?= Utils::esOpcionMenuActiva('/blog') ? 'active' : '' ?> lien">
          <a href="/blog"><i class="fa fa-file-text sr-icons"></i> Blog</a>
        </li>
        <li class="<?= Utils::esOpcionMenuActiva('/contact') ? 'active' : '' ?> lien">
          <a href="/contact"><i class="fa fa-phone-square sr-icons"></i> Contact</a>
        </li>

        <?php if (is_null($app['user'])): ?>
          
          <li class="<?= Utils::esOpcionMenuActiva('/login') ? 'active' : '' ?> lien">
            <a href="/login"><i class="fa fa-user-secret sr-icons"></i> Login</a>
          </li>
          
          <li class="<?= Utils::esOpcionMenuActiva('/registro') ? 'active' : '' ?> lien">
            <a href="/registro"><i class="fa fa-sign-in sr-icons"></i> Registro</a>
          </li>

        <?php else: ?>

          <li class="<?= Utils::esOpcionMenuActiva('/galeria') ? 'active' : '' ?> lien">
            <a href="/galeria"><i class="fa fa-image sr-icons"></i> Galería</a>
          </li>

          <li class="<?= Utils::esOpcionMenuActiva('/asociados') ? 'active' : '' ?> lien">
            <a href="/asociados"><i class="fa fa-handshake-o sr-icons"></i> Asociados</a>
          </li>

          <li class="<?= Utils::esOpcionMenuActiva('/logout') ? 'active' : '' ?> lien">
            <a href="/logout">
                <i class="fa fa-sign-out sr-icons"></i> 
                Logout (<?= $app['user']->getUsername() ?>)
            </a>
          </li>

        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>