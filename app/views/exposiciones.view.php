<div class="hero hero-inner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mx-auto text-center">
                <div class="intro-wrap">
                    <h1 class="mb-0">Exposiciones</h1>
                    <p class="text-white">Nuestras exposiciones temporales.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Listado de Exposiciones</h2>
            <div class="text-right mb-3" style="text-align: right;">
                <a href="/exposiciones/nueva" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Crear Nueva Exposición
                </a>
            </div>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($exposiciones)): ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay exposiciones creadas.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($exposiciones as $exposicion): ?>
                            <tr>
                                <td><?= $exposicion->getNombre() ?></td>
                                <td><?= substr($exposicion->getDescripcion(), 0, 50) ?>...</td>
                                <td><?= $exposicion->getFechaInicio() ?></td>
                                <td><?= $exposicion->getFechaFin() ?></td>
                                <td>
                                    <?php if($exposicion->getActiva()): ?>
                                        <span class="label label-success" style="background:green; padding:3px 6px; color:white; border-radius:3px;">Activa</span>
                                    <?php else: ?>
                                        <span class="label label-default">Cerrada</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>