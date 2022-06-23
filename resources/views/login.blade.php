<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ingreso al Sistema | Cuerpo de Bomberos Cantón Atacames </title>
    <link rel="shortcut icon" href="./assets/img/icons/logo.png" type="image/x-icon">
    <!-- Bootstrap -->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="./assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="./assets/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="./assets/css/custom.min.css" rel="stylesheet">
      <style>
          .login_content h1::before, .login_content h1::after {
              width: 10% !important;
          }
          .login_content form input[type="submit"], #content form .submit {
              float: none !important;
              margin-left: 38px;
          }
          .btnLogin:hover{
              border-bottom: 1px solid!important;
              color: #0056b3 !important;
          }
          .login {
              background: #FFF !important;
          }
      </style>

  </head>

  <body class="login" >
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content" style="width: 85%">
            <form method="POST" action="/login">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <h1>
                  Cuerpo de Bomberos Cantón Atacames V2
                  </h1>

                    <img src="./assets/img/icons/logo.png" alt="CB - atacames" >
                      <br>

              <div>
                <input type="email" class="form-control" name="email" id="password" placeholder="Correo Electrónico" required="" style="font-size: 15px;" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required=""  style="font-size: 15px;" />
              </div>
              <div>
                <input type="submit" class="btn btn-default submits btnLogin" style="border-block-color: cornflowerblue; font-size: 15px border: 2px;" value="Ingresar al Sistema">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>




                  <p>© {{ now()->year }} Todos los derechos reservados - CBA Atacames <br> </p>

                </div>
              </div>
            </form>
          </section>
        </div>

      </div>

    </div>

  </body>
</html>
