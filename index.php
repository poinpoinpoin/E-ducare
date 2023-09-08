<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="icon" href="./img/logo.png">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap');

      * {
          margin: 0;
          padding: 0;
      }

      body {
      
          margin: 0;
          padding: 0;
          background-color: #1C191A;
      }















      /* HEADER */
      header {
          height: 80px;
          border-bottom: 5px solid white;
          display: flex;
          flex-direction: row;
          justify-content: space-between;
          padding-left: 20px;
          padding-right: 0px;
          align-items: center;
      }


      /* LOGO */
      .logo {
          font-size: 40px;
          color: #07c373;
          font-weight: 700;
          text-decoration: none;
          font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      }


      /* MENU DE NAVEGACION */
      .nav {
          height: 50px;
          width: 150px;
          padding: 0 10px;
          display: flex;
          align-items: center;
          justify-content: right;
          background-color: transparent;
          position: relative;
          border: none;
      }

      .nav .nav-btn {
          display: none;
      }

      .nav .nav-links {
          width: 60%;
          display: inline-flex;
          justify-content: flex-end;
          text-align: center;
          border: none;
          border-radius: 0 0 0px 10px;
      }

      .nav .nav-links a {
          display: inline-block;
          padding: 10px 10px;
          text-decoration: none;
          color: white;
          font-size: 25px;
          font-family: Arial, Helvetica, sans-serif;
          text-align: center;
          font-weight: bold;
      }

      .nav .nav-links a:hover {
          background-color: rgba(0, 0, 0, 0.3);
      }

      .nav #nav-check {
          display: none;
      }

      @media (max-width:950px) {
          .nav .nav-btn {
              display: inline-block;
              position: absolute;
              right: 0px;
              top: 0px;
          }
        
          .nav .nav-btn label {
              display: flex;
              flex-direction: column;
              row-gap: 5px;
              width: 50px;
              height: 50px;
              padding: 15px;
          }
        
          .nav .nav-btn label:hover,
          .nav #nav-check:checked~.nav-btn label {
              cursor: pointer;
          }
        
          .nav .nav-btn label span {
              display: block;
              width: 25px;
              height: 5px;
              background-color: #eee;
              border-radius: 5px;
          }
        
          .nav .nav-links {
              position: absolute;
              display: block;
              width: 100%;
              background-color: #333;
              height: 0px;
              transition: all 0.3s ease-in;
              overflow-y: hidden;
              top: 70px;
              left: 0px;
          }
        
          .nav .nav-links a {
              display: block;
              width: 120px;
              padding-left: 20px;
              font-size: 20px;
              font-family: Arial, Helvetica, sans-serif;
              font-weight: bold;
              margin-left: 10px;
              margin-top: 10px;
          }
        
          .nav #nav-check:not(:checked)~.nav-links {
              height: 0px;
          }
        
          .nav #nav-check:checked~.nav-links {
              height: 190px;
              overflow-y: hidden;
          }
      }

      /* HEADER */















      /* MAIN */
      /* PRESENTACION */
      aside {
          text-align: center;
          margin-top: 70px;
          margin-bottom: 0px;
      }

      #presentacion {
          color: white;
          font-size: 70px;
          font-weight: 800;
          font-family: 'IBM Plex Sans';
      }

      aside span {
          color: #07c373;
          font-weight: 800;
      }

      .introduccion_presentacion {
          color: white;
          margin-top: 50px;
          margin-left: 10px;
          margin-right: 10px;
          font-size: 20px;
          font-weight: 200;
          text-align: center;
          line-height: 35px;
          font-family: Arial, Helvetica, sans-serif;
      }

      /* PORQUE ESTUDIAR CON NOSOTROS */
      .porque_estudiar_con_nosotros {
          margin-top: 70px;
          width: 100%;
          background-color: white;
          padding-top: 50px;
          padding-bottom: 50px;
      }

      .porque_estudiar_con_nosotros h2 {
          color: #07c373;
          font-size: 25px;
          font-weight: 200;
          text-align: left;
          margin-left: 30px;
          font-family: Arial, Helvetica, sans-serif;
      }

      .porque_estudiar_con_nosotros h3 {
          color: black;
          font-size: 30px;
          text-align: left;
          margin-left: 30px;
          font-weight: 70;
          font-family: Arial, Helvetica, sans-serif;
      }

      .porque_estudiar_con_nosotros_contenedor_de_cajas {
          display: flex;
          flex-direction: row;
          justify-content: center;
          flex-wrap: wrap;
      }

      .porque_estudiar_con_nosotros_cajas {
          width: 350px;
          text-align: left;
          margin-left: 20px;
          margin-top: 20px;
      }

      .porque_estudiar_con_nosotros_contenedor_de_cajas_titulo {
          font-family: Arial, Helvetica, sans-serif;
          color: black;
          font-size: 25px;
          font-weight: 600;
          margin-bottom: 15px;
      }

      .porque_estudiar_con_nosotros_contenedor_de_cajas_contenido {
          font-family: Arial, Helvetica, sans-serif;
          color: black;
          font-size: 15px;
          font-weight: 200;
      }

      /* CURSOS DISPONIBLES */
      #cursos_disponibles {
          margin-left: 40px;
          margin-right: 40px;
          margin-top: 100px;
      }

      .aside_titulo_cursos_disponibles {
          color: white;
          font-size: 35px;
          font-family: Arial, Helvetica, sans-serif;
          font-weight: 700;
          margin-bottom: 20px;
          margin-left: 40px;
          margin-right: 40px;
      }

      .aside_descripcion_de_cursos_disponibles {
          color: white;
          font-size: 18px;
          font-family: Arial, Helvetica, sans-serif;
          margin-left: 40px;
          margin-right: 40px;
          margin-bottom: 60px;
      }

      .contenedor_cursos_disponibles {
          display: flex;
          flex-direction: row;
          justify-content: center;
          flex-wrap: wrap;
          margin-top: 20px;
      }

      .caja_curso_disponible {
          border: 1px solid #07c373;
          width: 300px;
          height: 240px;
          margin: 10px;
          border-radius: 20px;
          padding: 20px;
      }

      .titulo_caja_curso_disponible {
          color: #07c373;
          font-family: Arial, Helvetica, sans-serif;
          text-align: center;
          font-size: 25px;
          margin-top: 10px;
          font-weight: bold;
          margin-bottom: 25px;
      }

      .contenido_caja_curso_disponible {
          color: white;
          text-align: center;
          font-family: Arial, Helvetica, sans-serif;
          font-size: 15px;
          font-weight: 0;
      }

      /* PLAN DE SUSCRIPCION */
      .titulo_caja_planes_de_suscripcion {
          text-align: center;
          color: #07c373;
          font-size: 40px;
          font-family: Arial, Helvetica, sans-serif;
          margin-bottom: 25px;
          margin-top: 50px;
      }

      .contenido_primera_linea_de_titulo_caja_planes_de_suscripcion {
          color: #07c373;
          font-size: 20px;
          font-family: Arial, Helvetica, sans-serif;
          text-align: center;
          font-weight: 700;
          margin-bottom: 10px;
      }

      .contenido_segunda_linea_de_titulo_caja_planes_de_suscripcion {
          color: white;
          font-size: 20px;
          font-family: Arial, Helvetica, sans-serif;
          text-align: center;
          margin-bottom: 50px;
      }

      #caja_planes_de_suscripcion {
          display: flex;
          flex-direction: row;
          justify-content: center;
          flex-wrap: wrap;
          margin-bottom: 90px;
      }

      /* CAJA DE SUSCRIPCION */
      .plan_de_suscripcion {
          border: 1px solid #07c373;
          width: 300px;
          height: 450px;
          margin: 20px;
          border-radius: 20px;
          padding: 20px;
          background-color: #13161c;
          position: relative;
      }

      .titulo_plan_de_suscripcion {
          color: white;
          text-align: center;
          font-size: 20px;
          font-family: Arial, Helvetica, sans-serif;
          font-weight: 1000;
          margin-bottom: 25px;
          margin-top: 25px;
      }

      .descripcion_plan_de_suscripcion {
          color: #8da2c0;
          text-align: center;
          margin-bottom: 20px;
          font-family: Arial, Helvetica, sans-serif;
      }

      .costo_del_plan {
          color: white;
          text-align: center;
          margin-bottom: 40px;
          margin-top: 30px;
          font-size: 30px;
          font-family: Arial, Helvetica, sans-serif;
          font-weight: bold;
      }

      .lista_de_beneficios_por_plan {
          color: #8da2c0;
          margin-left: 30px;
          font-size: 15px;
          font-family: Arial, Helvetica, sans-serif;
          margin-bottom: 50px;
      }

      .lista_de_beneficios_por_plan li {
          margin-bottom: 10px;
      }

      .plan_suscripcion_REGISTRO {
          font-family: Arial, Helvetica, sans-serif;
          font-weight: 800;
          font-size: 20px;
          background-color: #07c373;
          color: black;
          text-decoration: none;
          padding-top: 20px;
          padding-bottom: 20px;
          padding-left: 60px;
          padding-right: 60px;
          position: absolute;
          left: 17%;
          bottom: 0;
          margin-bottom: 50px;
          border-radius: 30px;
      }

      /* MAIN */















      /* FOOTER */
      footer {
          border-top: 5px solid white;
          padding-top: 40px;
      }

      .caja_logo_y_redes_sociales {
          display: flex;
          flex-direction: column;
          text-align: center;
          margin-top: 10px;
      }

      .logo_footer {
          font-size: 110px;
          color: #07c373;
          font-weight: 700;
          text-decoration: none;
          font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
      }
      
      .icono_redes_sociales {
          width: 80px;
      }

      .copyright_terminos_soporte {
          margin-top: 30px;
          margin-bottom: 30px;
          display: flex;
          flex-direction: row;
          justify-content: center;
          flex-wrap: wrap;
      }

      .copyright {
          color: white;
          text-decoration: none;
          font-size: 20px;
          margin-right: 20px;
      }

      .terminos {
          color: white;
          text-decoration: none;
          font-size: 20px;
          margin-right: 20px;
      }

      .soporte {
          color: white;
          text-decoration: none;
          font-size: 20px;
      }

      /* FOOTER */
    </style>
    <style>
        /* MAIN */
        /* BIENVENIDA */
        .titulo_bienvenida_que_desas_aprender_hoy {
            font-family: Arial, Helvetica, sans-serif;
            color: white;
            font-size: 70px;
            text-align: center;
            margin-top: 100px;
            font-weight: bold;
        }

        .resaltado_del_titulo {
            color: #07c373;
            font-size: 80px;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }

        .contenido_del_titulo_de_bienvenida_que_deseas_aprender_hoy {
            color: white;
            text-align: center;
            font-size: 20px;
            font-family: Arial, Helvetica, sans-serif;
            margin-top: 50px;
            line-height: 35px;
        }

        /* CURSOS */
        #cursos_disponibles {
            margin-left: 40px;
            margin-right: 40px;
            margin-top: 100px;
        }

        .contenedor_cursos_disponibles {
            display: flex;
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .caja_curso_disponible {
            border: 1px solid #07c373;
            width: 300px;
            height: 200px;
            margin: 10px;
            border-radius: 20px;
            padding: 20px;
            text-decoration: none;
        }

        .caja_curso_disponible {
            border: 4px solid #07c373;
            transition: border-color 0.2s ease;
        }

        .caja_curso_disponible:hover {
            border-color: white;
        }


        .titulo_caja_curso_disponible {
            color: #07c373;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            font-size: 25px;
            margin-top: 10px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .contenido_caja_curso_disponible {
            color: white;
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
            font-weight: 0;
        }
    </style>
</head>
<body>
    

    <?php if(!empty($user)): ?>
        <header>
            <a href="index.php" class="logo">
                E-ducare
            </a>
            <div class="nav">
                <input type="checkbox" id="nav-check">
                <div class="nav-btn">
                    <label for="nav-check">
                        <span></span>
                        <span></span>
                        <span></span>
                    </label>
                </div>
                <div class="nav-links">
                    <a href="logout.php">CERRAR</a>
                    <a target="_blank" href="./SOPORTE/soporte.html">SOPORTE</a>
                    <a target="_blank" href="./TERMINOS_Y_CONDICIONES/terminos_y_condiciones.html">TEyCO</a>
                </div>
            </div>
        </header>

        <!-- MAIN -->
        <main style="margin-bottom: 100px">
            <!-- BIENVENIDA -->
            <p class="titulo_bienvenida_que_desas_aprender_hoy">
                Bienvenido <?= $user['email']; ?>
            <p class="resaltado_del_titulo">¿Qué deseas aprender el día de hoy?</p>
            </p>
            <p class="contenido_del_titulo_de_bienvenida_que_deseas_aprender_hoy">
                ¡Bienvenidos, jóvenes talentosos, a un mundo lleno de posibilidades
                emocionantes! Aquí, en nuestra comunidad
                educativa, nos enorgullece presentarles un abanico de cursos que
                les permitirán explorar sus pasiones y
                moldear su futuro brillante. Elige con cuál deseas comenzar:
            </p>


            <!-- CURSOS -->
            <div id="cursos_disponibles">
                <div class="contenedor_cursos_disponibles">
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/Linux.html">
                        <p class="titulo_caja_curso_disponible">
                            Linux
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            Linux es un sistema operativo de código abierto que se basa en el kernel de Linux. Es conocido
                            por su estabilidad, seguridad y flexibilidad, y se utiliza en una amplia variedad de
                            dispositivos, desde servidores hasta computadoras personales.
                        </p>
                    </a>
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/Metodologías_Ágiles.html">
                        <p class="titulo_caja_curso_disponible">
                            Metodologías Ágiles
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            Las metodologías ágiles son enfoques colaborativos y flexibles para el desarrollo de software
                            que se centran en la adaptación continua, la entrega temprana de incrementos de software y la
                            retroalimentación constante.
                        </p>
                    </a>
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/Gestión_de_la_Información.html">
                        <p class="titulo_caja_curso_disponible">
                            Gestión de la Informacion
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            La gestión de la información se refiere al proceso de organizar, almacenar, recuperar y utilizar
                            información de manera efectiva.
                        </p>
                    </a>
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/Python.html">
                        <p class="titulo_caja_curso_disponible">
                            Python
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            Python es un lenguaje de programación interpretado y de alto nivel. Es conocido por su sintaxis
                            clara y legible, lo que lo hace fácil de aprender y usar.
                        </p>
                    </a>
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/HTML.html">
                        <p class="titulo_caja_curso_disponible">
                            HTML
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            El Lenguaje de Marcado de Hipertexto (HTML) es el código que se utiliza para estructurar y
                            desplegar una página web y sus contenidos. Por ejemplo, sus contenidos podrían ser párrafos, una
                            lista con viñetas, o imágenes y tablas de datos.
                        </p>
                    </a>
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/CSS.html">
                        <p class="titulo_caja_curso_disponible">
                            CSS
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            CSS es uno de los lenguajes más importantes que se utilizan para ordenar las instrucciones
                            referentes a la apariencia de un sitio y presentar los contenidos de una página de forma
                            atractiva. De este modo, HTML se emplea para estructurar el contenido de un sitio, mientras que
                            CSS se usa para estructurar su presentación.
                        </p>
                    </a>
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/JavaScript.html">
                        <p class="titulo_caja_curso_disponible">
                            JavaScript
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            JavaScript es un lenguaje de programación que los desarrolladores utilizan para hacer páginas
                            web interactivas. Desde actualizar fuentes de redes sociales a mostrar animaciones y mapas
                            interactivos, las funciones de JavaScript pueden mejorar la experiencia del usuario de un sitio
                            web.
                        </p>
                    </a>
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/React.html">
                        <p class="titulo_caja_curso_disponible">
                            React
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            React es una biblioteca de JavaScript para construir interfaces de usuario interactivas. Es
                            mantenido por Facebook y se utiliza ampliamente en el desarrollo web.
                        </p>
                    </a>
                    <a class="caja_curso_disponible" href="./CURSOS_DE_LA_ACADEMIA/PHP.html">
                        <p class="titulo_caja_curso_disponible">
                            PHP
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            PHP es un lenguaje de programación de uso general especialmente diseñado para el desarrollo web.
                            Es ampliamente utilizado para crear aplicaciones web dinámicas y sitios web interactivos.
                        </p>
                    </a>
                </div>
            </div>
        </main>


    <?php else: ?>


        <header>
            <a href="index.php" class="logo">
                E-ducare
            </a>
            <div class="nav">
                <input type="checkbox" id="nav-check">
                <div class="nav-btn">
                    <label for="nav-check">
                        <span></span>
                        <span></span>
                        <span></span>
                    </label>
                </div>
                <div class="nav-links">
                    <a href="login.php">INICIAR</a>
                    <a href="#cursos_disponibles">MATERIAS</a>
                    <a target="_blank" href="signup.php">INSCRIBETE</a>
                </div>
            </div>
        </header>

        <main>
            <!--PRESENTACION-->
            <aside id="presentacion">
                <span>
                    Para todos tus retos,
                </span>
                <br>
                estudia en E-ducare

                <p class="introduccion_presentacion">
                    Creemos firmemente que el conocimiento no debería tener fronteras. Por lo
                    tanto, hemos diseñado nuestra
                    academia web para que sea accesible desde cualquier lugar, en cualquier momento y a través de diversos
                    dispositivos. Esto permite que cualquier persona interesada en aprender pueda hacerlo a su propio ritmo
                    y
                    conveniencia.
                </p>

                <div class="porque_estudiar_con_nosotros">
                    <h2>¿CÓMO APRENDES CON E-DUCARE?</h2>
                    <h3 style="font-weight: 1000;">TE DAMOS LAS HERRAMIENTAS PARA CRECER</h3>

                    <div class="porque_estudiar_con_nosotros_contenedor_de_cajas">
                        <div class="porque_estudiar_con_nosotros_cajas">
                            <p class="porque_estudiar_con_nosotros_contenedor_de_cajas_titulo">Crea</p>
                            <p class="porque_estudiar_con_nosotros_contenedor_de_cajas_contenido">Adquiere el conocimiento
                                necesario para convertir tus ideas en nuevos proyectos.</p>
                        </div>
                        <div class="porque_estudiar_con_nosotros_cajas">
                            <p class="porque_estudiar_con_nosotros_contenedor_de_cajas_titulo">Comparte</p>
                            <p class="porque_estudiar_con_nosotros_contenedor_de_cajas_contenido">Conecta con una comunidad
                                de estudiantes y profesionales para potenciar tu aprendizaje.</p>
                        </div>
                        <div class="porque_estudiar_con_nosotros_cajas">
                            <p class="porque_estudiar_con_nosotros_contenedor_de_cajas_titulo">Transforma</p>
                            <p class="porque_estudiar_con_nosotros_contenedor_de_cajas_contenido">
                                Genera impacto con grandes proyectos que cambien al mundo.
                            </p>
                        </div>
                    </div>
                </div>
            </aside>

            <!--CURSOS DISPONIBLES-->
            <div id="cursos_disponibles">
                <p class="aside_titulo_cursos_disponibles">Nuestros cursos disponibles:</p>
                <p class="aside_descripcion_de_cursos_disponibles">
                    En nuestra academia, nos apasiona brindar oportunidades de aprendizaje en el apasionante mundo de
                    la tecnología. Te presentamos una variedad de cursos diseñados para ayudarte a adquirir las habilidades
                    necesarias y convertirte en un profesional exitoso en este campo de constante evolución.
                </p>
                <div class="contenedor_cursos_disponibles">
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            Linux
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            Linux es un sistema operativo de código abierto que se basa en el kernel de Linux. Es conocido
                            por su estabilidad, seguridad y flexibilidad, y se utiliza en una amplia variedad de
                            dispositivos, desde servidores hasta computadoras personales.
                        </p>
                    </div>
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            Metodologías Ágiles
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            Las metodologías ágiles son enfoques colaborativos y flexibles para el desarrollo de software
                            que se centran en la adaptación continua, la entrega temprana de incrementos de software y la
                            retroalimentación constante.
                        </p>
                    </div>
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            Gestión de la Informacion
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            La gestión de la información se refiere al proceso de organizar, almacenar, recuperar y utilizar
                            información de manera efectiva.
                        </p>
                    </div>
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            Python
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            Python es un lenguaje de programación interpretado y de alto nivel. Es conocido por su sintaxis
                            clara y legible, lo que lo hace fácil de aprender y usar.
                        </p>
                    </div>
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            HTML
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            El Lenguaje de Marcado de Hipertexto (HTML) es el código que se utiliza para estructurar y
                            desplegar una página web y sus contenidos. Por ejemplo, sus contenidos podrían ser párrafos, una
                            lista con viñetas, o imágenes y tablas de datos.
                        </p>
                    </div>
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            CSS
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            CSS es uno de los lenguajes más importantes que se utilizan para ordenar las instrucciones
                            referentes a la apariencia de un sitio y presentar los contenidos de una página de forma
                            atractiva. De este modo, HTML se emplea para estructurar el contenido de un sitio, mientras que
                            CSS se usa para estructurar su presentación.
                        </p>
                    </div>
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            JavaScript
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            JavaScript es un lenguaje de programación que los desarrolladores utilizan para hacer páginas
                            web interactivas. Desde actualizar fuentes de redes sociales a mostrar animaciones y mapas
                            interactivos, las funciones de JavaScript pueden mejorar la experiencia del usuario de un sitio
                            web.
                        </p>
                    </div>
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            React
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            React es una biblioteca de JavaScript para construir interfaces de usuario interactivas. Es
                            mantenido por Facebook y se utiliza ampliamente en el desarrollo web.
                        </p>
                    </div>
                    <div class="caja_curso_disponible">
                        <p class="titulo_caja_curso_disponible">
                            PHP
                        </p>
                        <p class="contenido_caja_curso_disponible">
                            PHP es un lenguaje de programación de uso general especialmente diseñado para el desarrollo web.
                            Es ampliamente utilizado para crear aplicaciones web dinámicas y sitios web interactivos.
                        </p>
                    </div>
                </div>
            </div>

            <!--PLANES DE SUSCRIPCION-->
            <p class="titulo_caja_planes_de_suscripcion">Elige un plan</p>
            <p class="contenido_primera_linea_de_titulo_caja_planes_de_suscripcion">
                Ahorra con un plan anual y accede a
                todos los cursos y contenidos exclusivos.
            </p>
            <p class="contenido_segunda_linea_de_titulo_caja_planes_de_suscripcion">
                Nunca subiremos el precio mientras mantengas tu suscripción activa.
            </p>

            <div id="caja_planes_de_suscripcion">

                <!--BASICO-->
                <div class="plan_de_suscripcion">
                    <p class="titulo_plan_de_suscripcion">
                        BÁSICO
                    </p>
                    <p class="descripcion_plan_de_suscripcion">
                        Pago semanal con renovación automática para 1 persona
                    </p>
                    <p class="costo_del_plan">
                        S/5.00 /semana
                    </p>
                    <ul class="lista_de_beneficios_por_plan">
                        <li>Acceso a cursos básicos</li>
                        <li>Acceso al material de las clases</li>
                    </ul>
                    <a href="signup.php" class="plan_suscripcion_REGISTRO">
                        Regístrate
                    </a>
                </div>

                <!--INTERMEDIO-->
                <div class="plan_de_suscripcion">
                    <p class="titulo_plan_de_suscripcion">
                        INTERMEDIO
                    </p>
                    <p class="descripcion_plan_de_suscripcion">
                        Pago mensual con renovación automática para 2 personas
                    </p>
                    <p class="costo_del_plan">
                        S/20.00 /mes
                    </p>
                    <ul class="lista_de_beneficios_por_plan">
                        <li>Acceso a cursos básicos</li>
                        <li>Acceso al material de las clasese</li>
                        <li>Reuniones grupales</li>
                    </ul>
                    <a href="signup.php" class="plan_suscripcion_REGISTRO">
                        Regístrate
                    </a>
                </div>

            <!--AVANZADO-->
                <div class="plan_de_suscripcion">
                    <p class="titulo_plan_de_suscripcion">
                        AVANZADO
                    </p>
                    <p class="descripcion_plan_de_suscripcion">
                        Pago anual con renovación automática para 3 personas
                    </p>
                    <p class="costo_del_plan">
                        S/230.00 /año
                    </p>
                    <ul class="lista_de_beneficios_por_plan">
                        <li>Acceso a cursos básicos</li>
                        <li>Acceso al material de las clasese</li>
                        <li>Reuniones grupales</li>
                        <li>Tutorías personalizadas</li>
                    </ul>
                    <a href="signup.php" class="plan_suscripcion_REGISTRO">
                        Regístrate
                    </a>
                </div>
            </div>
        </main>

    <?php endif; ?>

    <?php require 'partials/footer.php' ?>
</body>
</html>