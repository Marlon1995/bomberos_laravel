<!DOCTYPE html>
<html lang="en"  style="    background: radial-gradient(black, transparent);" >
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

          body {
            background: red;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .login-wrapper {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
        }

        .card {
          background: red;
            background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)),
                        url('/assets/img/users/fondo.jpg') no-repeat center center fixed;
            background-size: cover;
           
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login_content h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .login_content img {
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 2px solid #3498db;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
        }

        .btnLogin {
            width: 80%;
          
            background-color: #3498db;
            color: #fff;
            border: 2px solid #3498db;
            border-radius: 5px;
            font-size: 16px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .btnLogin:hover {
            background-color: #007bff;
            border-color: #007bff;
        }

        .separator p {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-top: 20px;
        }
      </style>

  </head>

  <body class="login"  >
    <div  style="background: radial-gradient(black, transparent);" >
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
      <div class="card">
          <section class="login_content" style="width: 85%">
         
            <form method="POST" action="/login">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <h1>Sistema de permisos de funcionamiento                  </h1>

                    <img src="./assets/img/icons/Logo1.png" alt="CB - atacames" >
                      <br>

              <div>
              <input type="email" class="form-control" name="email" id="email" placeholder="Correo Electrónico" required="" style="font-size: 16px; padding: 12px; border: 2px solid #3498db; border-radius: 5px; box-sizing: border-box;">
              </div>
              <div>
              <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required="" style="font-size: 16px; padding: 12px; border: 2px solid #3498db; border-radius: 5px; box-sizing: border-box;">
              </div>
              <div>
              <input type="submit" class="btn btn-primary btnLogin" style="background-color: #3498db; color: #fff; font-size: 12px; border: 2px solid #3498db;  text-transform: uppercase;" value="Ingresar">
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
