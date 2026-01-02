<div class="hero hero-inner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mx-auto text-center">
                <div class="intro-wrap">
                    <h1 class="mb-0">Nueva Exposición</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Datos de la Exposición</h3></div>
                <div class="panel-body">
                    <form action="/exposiciones/guardar" method="POST">
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Descripción:</label>
                            <textarea name="descripcion" rows="4" class="form-control"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha Inicio:</label>
                                    <input type="date" name="fecha_inicio" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha Fin:</label>
                                    <input type="date" name="fecha_fin" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center mt-4" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="/exposiciones" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>