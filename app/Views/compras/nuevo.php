<?php $id_compra = uniqid(); ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid ">

            <form method="POST" action="<?php echo base_url(); ?>/compras/guarda" autocomplete="off">

                <div>
                    <br>
                </div>

                <div class="form-group">
                    <div class="row">

                        <div class="col-12 col-sm-4">
                            <input type="hidden" id="id_producto" name="id_producto">
                            <label for="">Codigo</label>
                            <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escribe el codigo y enter" onkeyup="buscarProducto(event, this, this.value)" autofocus />
                            <label for="codigo" id="resultado_error" style="color: red"></label>
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Nombre del producto</label>
                            <input class="form-control" id="nombre" name="nombre" type="text" disabled />
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Cantidad</label>
                            <input class="form-control" id="cantidad" name="cantidad" type="text" />
                        </div>

                    </div>
                </div>

                <div>
                    <br>
                </div>

                <div class="form-group">
                    <div class="row">

                        <div class="col-12 col-sm-4">
                            <label for="">Precio de compra</label>
                            <input class="form-control" id="precio_compra" name="precio_compra" type="text" disabled />
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Subtotal</label>
                            <input class="form-control" id="subtotal" name="subtotal" type="text" disabled />
                        </div>

                        <div class="col-12 col-sm-4">
                            <label><br>&nbsp;</label>
                            <button id="agregar_producto" name="agregar_producto" type="button" class="btn btn-primary" 
                            onclick="agregarProducto(id_producto.value, cantidad.value, '<?php echo $id_compra; ?>')">Agregar producto</button>
                        </div>

                    </div>
                </div>

                <div><br></div>


                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="tablaProductos" class="table table-hover table-striped table-sm" width="100%">
                                <thead class="thead-dark">
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th width="1%"></th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-12 col-sm-6 offset-md-6">
                        <label style="font-weight:bold; font-size: 30px; text-align: center;">Total $</label>
                        <input type="text" id="total" name="total" size="7" readonly="true" value="0.00" style="font-weight:bold; font-size: 30px; text-align: center;">
                        <button type="button" id="completa_compra" class="btn btn-success">Completar compra</button>
                    </div>
                </div>

            </form>

        </div>
    </main>

    <script>
        $(document).ready(function() {

        });

        function buscarProducto(e, tagCodigo, codigo) {
            var enterkey = 13;

            if (codigo != '') {
                if (e.which == enterkey) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                        dataType: 'json',
                        success: function(resultado) {
                            if (resultado == 0) {
                                $(tagCodigo).val('');
                            } else {
                                $(tagCodigo).removeClass('has-error');

                                $("#resultado_error").html(resultado.error);

                                if (resultado.existe) {
                                    $("#id_producto").val(resultado.datos.id);
                                    $("#nombre").val(resultado.datos.nombre);
                                    $("#cantidad").val(1);
                                    $("#precio_compra").val(resultado.datos.precio_compra);
                                    $("#subtotal").val(resultado.datos.precio_compra);
                                    $("#cantidad").focus();
                                } else {
                                    $("#id_producto").val('');
                                    $("#nombre").val('');
                                    $("#cantidad").val('');
                                    $("#precio_compra").val('');
                                    $("#subtotal").val('');
                                }
                            }
                        }
                    });
                }
            }
        }

        function agregarProducto(id_producto, cantidad, id_compra) {
            if (id_producto != null && id_compra != 0 && cantidad > 0) {
                $.ajax({
                    url: '<?php echo base_url(); ?>/TemporalCompra/inserta/' + id_producto + "/" + cantidad + "/" + id_compra,
                    success: function(resultado) {
                        if (resultado == 0) {

                        } else {

                            var resultado = JSON.parse(resultado);
                            if (resultado.error == '') {
                                $("#tablaProductos tbody").empty();
                                $("#tablaProductos tbody").append(resultado.datos);
                                $("#total").val(resultado.total);
                                $("#id_producto").val('');
                                $("#codigo").val('');
                                $("#nombre").val('');
                                $("#cantidad").val('');
                                $("#precio_compra").val('');
                                $("#subtotal").val('');
                            }
                        }
                    }
                });
            }
        }
    </script>