<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://code.jquery.com/jquery-3.7.1.min.js" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/775fd40529.js" crossorigin="anonymous"></script>
    <script src="https://momentjs.com/downloads/moment.min.js" crossorigin="anonymous"></script>
    <title>Estoque</title>

</head>

<body>

    <nav class="navbar navbar-dark bg-dark" aria-label="First navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Email</a>
        </div>
    </nav>

    <div class="container-fluid">


        <div class="card mt-3">
            <div class="card-header">
                 Formulário para envio de e-mail
            </div>
            <div class="card-body m-1">
                <form id="formEmail">
                    <div class="row">
                        <div class="col-12 P-2">
                            <div class="alert alert-danger d-none" id="alert" role="alert">
                                <h4 class="alert-heading">Atenção!</h4>
                                <hr>
                                <div id="msg" class="mb-0 pb-0 text-dark"></div>
                                <hr>
                                <p class="alert-heading mb-0 text-dark">Corrija os campos acima.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-2">
                        <div class="row mt-2 mb-2">
                            <div class="col-2">
                                <label for="inputState">Serviço de email:</label>
                                <select id="TPemail" name="TPemail" class="form-control" alt="Outlook" disabled>
                                    <option value="outlook">Outlook</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <label>Email remetente:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite um email outlook.">
                            </div>
                            <div class="col-5">
                                <label>Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha do email">
                            </div>
                        </div>
                    </div>

                    <!-- <hr> -->

                    <div class="mt-2">
                        <div class="row mt-3">
                            <label>Email destinatario:</label>
                            <input type="email" class="form-control" id="EmailDest" name="EmailDest" placeholder="Digite o email do destinatario">
                        </div>
                        <div class="row  mt-3">
                            <label>Texto:</label>
                            <textarea type="text" class="form-control" id="textoDest" name="textoDest" placeholder="Texto que será exibido no email" rows="3"></textarea>
                        </div>

                        <div class="row  mt-3">
                            <label>Quantidade:</label>
                            <input type="number" class="form-control" id="QtdeDest" name="QtdeDest" placeholder="Quantidade de emails enviados">
                        </div>
                    </div>

                    <div class="row">
                        <!-- <button type="button" class="btn btn-primary mt-3" onclick="enviaEmail()">Enviar</button> -->

                        <div class="position-relative">
                            <div class="position-absolute top-0 start-0"></div>
                            <div class="position-absolute top-0 start-50 translate-middle-x"></div>
                            <div class="position-absolute top-0 end-0"></div>
                            <div class="position-absolute top-50 start-0 translate-middle-y"></div>
                            <div class="position-absolute top-50 start-50 translate-middle"></div>
                            <div class="position-absolute top-50 end-0 translate-middle-y"></div>
                            <div class="position-absolute bottom-0 start-0"></div>
                            <div class="position-absolute bottom-0 start-50 translate-middle-x"></div>
                            <div class="position-absolute bottom-0 end-0"></div>
                        </div>




                    </div>

                </form>
            </div>
        </div>


    </div>

    <script>
        function enviaEmail() {
            $.ajax({
                url: "http://localhost/Email/index.php/mail/enviaEmail",
                type: "POST",
                dataType: 'json',
                data: $('#formEmail').serialize(),
                beforeSend: function() {
                    Swal.fire({
                        title: "Aguarde!",
                        text: "Buscando dados...",
                        imageUrl: '',
                        imageWidth: 100,
                        imageHeight: 80,
                        showConfirmButton: false
                    })
                },
                error: function(data_error) {
                    Swal.fire("Oops...", "Aguarde alguns minutos antes de tentar novamente!", "info");
                },
                success: function(result) {

                    console.log(result);
                    if (result.cod == 1) {
                        Swal.fire("OK", "Mensagem enviada com sucesso!", "success");
                        $('#alert').addClass('d-none');
                    } else if (result.cod == 2) {
                        Swal.fire({
                            timer: 100,
                            title: "Aguarde!",
                            text: "Cadastrando os dados...",
                            imageUrl: '',
                            showConfirmButton: false
                        });
                        $('#msg').html(result.mensagens);
                        $('#alert').removeClass('d-none');
                    } else {
                        Swal.fire("Oops...", "Favor verificar se não existem informações erradas!", "info");
                    }
                },
            });
        }
    </script>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- SwallAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
    <!-- Latest compiled and minified Locales -->
    <!-- <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/locale/bootstrap-table-zh-CN.min.js"></script> -->


    <div id="footer">
        <footer id="sticky-footer" class="flex-shrink-0 py-1 bg-dark text-white-50 fixed-bottom">
            <div class="container text-center">
                <small>Copyright &copy; Seu site</small>
            </div>
        </footer>
    </div>

</body>

</html>