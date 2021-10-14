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
                            <input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escribe el codigo y enter"
                            onkeyup="buscarProducto(event, this, this.value)" autofocus />
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
                            <input class="form-control" id="precio_compra" name="precio_compra" type="text" placeholder="Escribe el codigo y enter" autofocus />
                        </div>

                        <div class="col-12 col-sm-4">
                            <label for="">Subtotal</label>
                            <input class="form-control" id="subtotal" name="subtotal" type="text" disabled />
                        </div>

                        <div class="col-12 col-sm-4">
                            <label><br>&nbsp;</label>
                            <button id="agregar_producto" name="agregar_producto" type="button" class="btn btn-primary">Agregar producto</button>
                        </div>

                    </div>
                </div>

                <div><br></div>

                <style>
                    .thead-green {
                        background-color: rgb(0, 99, 71);
                        color: white;
                    }
                </style>

                
                    <div class="row">
                        <table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos" width="100%">
                            <thead class="thead-green">
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
        $(document).ready(function(){

        });
        function buscarProducto(e, tagCodigo, codigo){
            var enterkey = 13;

            if(codigo != ''){
                if(e.which == enterkey){
                    $.ajax({
                        url: '<?php echo base_url(); ?>/productos/buscarPorCodigo/' + codigo,
                        dataType: 'json',
                        success: function(resultado){
                            if(resultado == 0){
                                $(tagCodigo).val('');
                            }else{
                                $(tagCodigo).removeClass('has-error');

                                $("#resultado_error").html(resultado.error);

                                if(resultado.exite){
                                    $("#id_producto").val(resultado.datos.id);
                                    $("#nombre").val(resultado.datos.nombre);
                                    $("#cantidad").val(1);
                                    $("#precio_compra").val(resultado.datos.precio_compra);
                                    $("#subtotal").val(resultado.datos.precio_compra);
                                    $("#cantidad").focus();
                                }else {
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
    </script>