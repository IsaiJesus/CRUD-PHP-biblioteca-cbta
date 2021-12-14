<?php  include("db.php") ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
      integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styles.css" />
    <title>Biblioteca CBTa 39</title>
  </head>
  <body>
    <div class="container-fluid p-0">
      <div class="d-flex">
        <div class="min-vh-100 dashboard">
          <div class="d-flex flex-column align-items-start p-3">
            <a
              href="http://cbta39.com.mx"
              class="
                d-flex
                align-items-center
                ps-0
                p-2
                text-decoration-none
                section
              "
            >
              <img
                src="images/CBTA39.png"
                class="pe-2"
                alt="CBTa 39"
                width="60"
              />
              <p class="m-0">CBTa 39</p>
            </a>
            <a
              href="index.php"
              class="
                p-2
                text-decoration-none
                d-flex
                align-items-center
                my-2
                section
              "
            >
              <span class="fas fa-book fs-5 pe-2"></span>
              <p class="m-0">Libros</p>
            </a>
            <a
              href="encargados.php"
              class="
                p-2
                text-decoration-none
                d-flex
                align-items-center
                my-2
                section
              "
            >
              <span class="fas fa-chalkboard-teacher fs-5 pe-2"></span>
              <p class="m-0">Encargados</p>
            </a>
            <a
              href="alumnos.php"
              class="
                p-2
                text-decoration-none
                d-flex
                align-items-center
                my-2
                section
              "
            >
              <span class="fas fa-graduation-cap fs-5 pe-2"></span>
              <p class="m-0">Alumnos</p>
            </a>
          </div>
        </div>
        <div class="container-fluid p-0 w-100">
          <nav
            class="
              navbar navbar-light
              bg-light
              d-flex
              align-items-center
              justify-content-center
              py-3
            "
          >
            <div
              class="
                bg-white
                d-flex
                border border-dark
                search-navbar
                rounded
                p-2
              "
            >
              <button
                class="fas fa-search border-0 bg-transparent py-1 px-2"
              ></button>
              <input
                type="text"
                placeholder="Busca algún libro"
                class="border-0 input-search"
              />
            </div>
          </nav>
          <section class="d-flex flex-column py-4 px-5">
            <header
              class="
                d-flex
                align-items-center
                justify-content-between
                border-bottom
                pb-3
              "
            >
              <div class="d-flex align-items-center form-submit">
                <span class="fas fa-book fs-1 pe-3"></span>
                <h1 class="m-0">Libros</h1>
              </div>
              <a href="new-book.html" class="btn btn-primary btn-lg fs-6">
                <span class="fas fa-plus pe-2"></span>
                Agregar nuevo libro
              </a>
            </header>

            <?php if(isset($_SESSION['message'])){ ?>
            <div
              class="
                alert alert-<?=
                $_SESSION['message_type'];
                ?>
                alert-dismissible
                fade
                show
                mt-3
                mb-0
              "
              role="alert"
            >
              <?= $_SESSION['message'] ?>
              <button
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
            </div>
            <?php session_unset(); } ?>

            <?php
              $sql = "SELECT * FROM libros";
              $num_rows = mysqli_num_rows(mysqli_query($conn, $sql));
                if($num_rows==0){ ?>
            <div class="row mt-4">
              <div
                class="
                  col-6
                  d-flex
                  flex-column
                  align-items-center
                  justify-content-center
                  text-center
                "
              >
                <h3 class="no-books fs-2">No hay libros agregados.</h3>
                <h5 class="no-books fs-4">Agrega un nuevo libro.</h5>
              </div>
              <div class="col-6">
                <img
                  src="images/noLibros.png"
                  alt="No hay libros"
                  width="500"
                />
              </div>
            </div>
            <?php }else{ ?>

            <div class="row mt-4">
              <?php

              $result_books = mysqli_query($conn, $sql);
              
              while($row = mysqli_fetch_array($result_books)) { ?>
              <div class="col-4 p-2">
                <div class="card bg-light">
                  <div class="card-header bg-light">
                    <h5 class="card-title">
                      <?php
                            echo $row['title_book']
                          ?>
                    </h5>
                    <p class="card-text">
                      <?php
                            echo $row['materia_book']
                          ?>
                    </p>
                  </div>
                  <div class="card-body d-flex justify-content-between">
                    <a
                      href="edit_libro.php?id=<?php echo $row['id_libro'] ?>"
                      class="btn btn-warning"
                    >
                      Editar
                      <span class="fas fa-pen ps-1"></span>
                    </a>
                    <a
                      href="delete_libro.php?id=<?php echo $row['id_libro'] ?>"
                      class="btn btn-danger"
                    >
                      Eliminar
                      <span class="fas fa-trash-alt ps-1"></span>
                    </a>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>

            <?php } ?>
          </section>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
