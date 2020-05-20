<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body style="background: #ccc">

    <?php include_once "partiels/header.php"; ?>

    <div class="container" id="appCategoria">

        <main class="my-3">

            <button type="button" class="btn btn-primary float-right my-3" data-toggle="modal" data-target="#modalCategoria">
                Agregar Categoria
            </button>

            <table class="table table-dark table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Categoria</th>
                        <th>Imagen</th>
                        <th>Fecha</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in categorias">
                        <th scope="row">{{ item.id }}</th>
                        <td>{{ item.titulo }}</td>
                        <td class="text-center"><img :src="item.img" width="80" height="80" class="rounded-circle" alt=""></td>
                        <td>{{ item.created_at }}</td>
                        <td class="text-center"><a data-toggle="modal" @click="llenarModal(item)" data-target="#editarCategoria" class="btn btn-warning btn-sm" href="#">Editar</a> <a class="btn btn-danger btn-sm" @click="eliminarCategoria(item.id)">Eliminar</a></td>
                    </tr>
                </tbody>
            </table>
            <pre>{{ $data }}</pre>
        </main>


        <div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="modalCategoria" aria-hidden="true">
            <!-- Modal agregar -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCategoria">Agregar Categorias</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" @blur="verificaAgregar()" v-model="titulo" class="form-control" autofocus>
                                <span :class="mensaje_titulo">{{mensaje}}</span>
                            </div>
                            <div class="form-group">
                                <label for="">URL</label>
                                <input type="text" readonly v-model="generarURL" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" v-model="img" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" @click="agregarCategoria()" :class="['btn','btn-primary',boton_status]">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editarCategoria" tabindex="-1" role="dialog" aria-labelledby="editarCategoria" aria-hidden="true">
            <!-- Modal editar -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarCategoria">Editar Categorias</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="text" v-model="id" hidden>
                            <div class="form-group">
                                <label for="">Titulo</label>
                                <input type="text" @keypress="verificaEdita()" v-model="tituloE" class="form-control" @focus>
                                <span :class="mensaje_titulo">{{mensaje}}</span>
                            </div>
                            <div class="form-group">
                                <label for="">URL</label>
                                <input type="text" readonly v-model="generarURLE" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Imagen</label>
                                <input type="file" @change="getImage" v-model="imgE" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" @click="editarCategoria()" :class="['btn','btn-warning',boton_status]">Guardar</button>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <?php
    include_once "partiels/footer.php";
    ?>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="vue/vue.min.js"></script>
<script src="vue/axios.min.js"></script>
<script src="vue/sweetalert2.js"></script>
<script src="vue/categoria.js"></script>

</html>