<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4"><?php echo $titulo; ?></h3>

            <?php if (isset($validation)) { ?>
                <div class="alert alert-danger" >
                <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>

            <form method="POST" action="<?php echo base_url(); ?>/usuarios/actualizar_password" autocomplete="off">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="">Usuario</label>
                            <input class="form-control" id="usuario" name="usuario" type="text" value="<?php echo $usuario['usuario']; ?>" disabled>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="">Nombre </label>
                            <input class="form-control" id="nombre" name="nombre" type="text" value="<?php echo $usuario['nombre']; ?>" disabled>
                        </div>
                    </div>
                </div>
                <div>
                    <br>
                </div>
                <form method="POST" action="<?php echo base_url(); ?>/usuarios/actualizar_password" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="">Contraseña</label>
                                <input class="form-control" id="password" name="password" type="password" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="">Confirma contraseña</label>
                                <input class="form-control" id="repassword" name="repassword" type="password" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <br>
                    </div>
                    <a href="<?php echo base_url(); ?>/unidades" class="btn btn-primary">Regresar</a>
                    <button type="submit" class="btn btn-success">Guardar</button>

                    <?php if (isset($mensaje)) { ?>
                        <div class="alert alert-success" >
                            <?php echo $mensaje; ?>
                        </div>
                    <?php } ?>

                </form>

        </div>
    </main>