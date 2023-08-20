<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Facturacion</title>
        <link href="<?=base_url?>Assets/css/styles.css" rel="stylesheet" />
        <script src="<?=base_url?>Assets/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">iniciar
                                        Sesion</h3></div>
                                    <div class="card-body">
                                        <form method="POST" id="frmLogin">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="nick" name="nick" type="text" placeholder="nick" />
                                                <label for="nick">Nick</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="clave" name="clave" type="password" placeholder="Password" />
                                                <label for="clave">Clave de Acceso</label>
                                            </div>
                                            <div class="alert alert-danger text-center d-none" role="alert" id="alerta">

                                            </div>
                                            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <a class="btn btn-primary" type="submit" onclick="frmLogin(event);">Ingresar</a>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; https://infbol.com/ <?=date('Y')?></div>
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?=base_url?>Assets/js/jquery-3.6.3.js"></script>
        <script src="<?=base_url?>Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=base_url?>Assets/js/scripts.js"></script>
        <script>
            const base_url="<?=base_url?>"
        </script>
        <script src="<?=base_url?>Assets/js/login.js"></script>
    </body>
</html>

                        