<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com PHP, PDO e Mysql</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
</head>
<body>

    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#"><i class="fab fa-wolf-pack-battalion"></i>&nbsp;CONPROC</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto"><!-- OBS: 'ml-auto' faz com que o menu fique alinhado à direita -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contato</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-center text-danger font-weight-normal my-3">APLICAÇÃO USANDO PHP-POO, PDO, MYSQL, AJAX, DATATABLE, BOOTSTRAP 4 E SWEETALERT 2</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h4 class="mt-2 text-primary">Todos os usuários da base de dados!</h4>
            </div>
            <div class="col-lg-6">
                <button class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal"><i class="fas fa-user-plus fa-lg"></i>&nbsp;&nbsp;Adiconar novo usuário</button>

                <a href="action.php?export=excel" class="btn btn-success m-1 float-right"><i class="fas fa-table fa-lg"></i>&nbsp;&nbsp;Exportar para o Excel</a>

            </div>
        </div>
        <hr class="my-1">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive" id="showUser">
                    <!-- A tabela com os registros do banco de dados será inserida aqui -->
                    <h3 class="text-center text-success" style="margin-top: 150px;">Carregando...</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Adicionar novo usuário Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar novo usuário</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="form-data" autocomplete="off">
                        <div class="form-group">
                            <input type="text" name="fname" class="form-control" placeholder="Primeiro nome" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" class="form-control" placeholder="Último nome" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" placeholder="Telefone" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="insert" id="insert" class="btn btn-danger btn-block" value="Adicionar usuário">
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Editar usuário Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Editar usuário</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body px-4">
                    <form action="" method="post" id="edit-form-data" autocomplete="off">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <input type="text" name="fname" class="form-control" id="fname" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" class="form-control" id="lname" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" class="form-control" id="phone" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="update" id="update" class="btn btn-primary btn-block" value="Atualizar usuário">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Fontawsome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- DataTable -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script>
        $(document).ready(function() {
            
            //retornar registros do banco de dados e gerar tabela
            showAllUsers()
            function showAllUsers() {
                $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: {action: 'view'},
                    success: function(response) {
                       // console.log(response)
                       $('#showUser').html(response) //'showUser' é o ID da div onde eu quero que a tabela seja inserida
                       $('table').DataTable({
                           order: [0, 'desc']
                       })
                    }
                })
            }

            //inserir usuário (ajax request)
            $('#insert').click(function(e) { // 'insert' é o ID do botão submeter do formulário de cadastro de novo usuário
                if ($('#form-data')[0].checkValidity()) {
                    e.preventDefault()
                    $.ajax({
                        url: 'action.php',
                        type: 'POST',
                        data: $('#form-data').serialize()+'&action=insert',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuário cadastrado com sucesso!'
                            })
                            $('#addModal').modal('hide') // 'addModal' é o ID da div modal
                            $('#form-data')[0].reset()
                            showAllUsers()
                        }
                    })
                }
            })

            //editar usuário
            $('body').on('click', '.editBtn', function(e) {
                e.preventDefault()
                edit_id = $(this).attr('id')
                $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: {edit_id:edit_id},
                    success: function(response) {
                        data = JSON.parse(response)
                        $('#id').val(data.id)
                        $('#fname').val(data.primeiro_nome)
                        $('#lname').val(data.ultimo_nome)
                        $('#email').val(data.email)
                        $('#phone').val(data.phone)
                    }
                })
            })

            //atualizar usuário (ajax request)
            $('#update').click(function(e) { // 'insert' é o ID do botão submeter do formulário de cadastro de novo usuário
                if ($('#edit-form-data')[0].checkValidity()) {
                    e.preventDefault()
                    $.ajax({
                        url: 'action.php',
                        type: 'POST',
                        data: $('#edit-form-data').serialize()+'&action=update',
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Usuário atualizado com sucesso!'
                            })
                            $('#editModal').modal('hide') // 'addModal' é o ID da div modal
                            $('#edit-form-data')[0].reset()
                            showAllUsers()
                        }
                    })
                }
            })

            //Deletar usuário (ajax request)
            $('body').on('click', '.delBtn', function(e) {
                e.preventDefault()
                var tr = $(this).closest('tr')
                del_id = $(this).attr('id')

                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Essa operação é irreversível!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, deletar!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: 'action.php',
                            type: 'POST',
                            data: {del_id:del_id},
                            success: function(response) {
                                tr.css('background-color', '#ff6666')
                                Swal.fire(
                                    'Deletado!',
                                    'Usuário deletado com sucesso!',
                                    'success'
                                )
                                showAllUsers()
                            }
                        })
                    }
                })
            })

            //mostrar detalhes do usuário
            $('body').on('click', '.infoBtn', function(e) {
                e.preventDefault()
                info_id = $(this).attr('id')
                $.ajax({
                    url: 'action.php',
                    type: 'POST',
                    data: {info_id:info_id},
                    success: function(response) {
                        //console.log(response)
                        data = JSON.parse(response)
                        Swal.fire({
                            icon: 'info',
                            title: '<strong>Informações do Usuário: ID(' + data.id + ')</strong>',
                            html: '<b>Primeiro nome: </b>' + data.primeiro_nome + '<br><b>Último nome: </b>' + data.ultimo_nome + '<br><b>Email: </b>' + data.email + '<br><b>Telefone: </b>' + data.phone,
                            showCancelButton: true
                        })
                    }
                })
            })
        })
    </script>

</body>
</html>