<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- My custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="css\main.css">
    <!-- My custom fonts -->
    <link rel="stylesheet" href="https://use.typekit.net/yre1wxl.css">
    <!-- Rich text editor -->
    <script src="https://cdn.tiny.cloud/1/e3pld2hc70whj1nj4zydy2wkyqbz8shdd6vqs8velprjcktb/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    // my tinymce editor code - custom toolbar, custom menubar etc etc
      tinymce.init({
        selector: '#tinyeditor',
        menubar: "false",
        toolbar: "undo redo | bold italic underline strikethrough blockquote ",
        height: 300
      });
    </script>
    <!-- favicon for browser tab -->
    <link rel='shortcut icon' type='image/png' href='images/vrlogo.png'>
    <title>SmallTech</title>
  </head>
  <body>

    <?php 
      // Code for running my site as a one-page/data base driven website
      include("navbar.php");
    ?>

    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 col-md-10 col-sm-11 text-bg-color">
          <?php
              // checks if page is set and loads said page if so, otherwise you're redirected to  home.php
              if (isset($_GET['page'])){
                $page = $_GET['page'];
                if (file_exists("$page.php")){
                  include("$page.php");
                }
              } else {
                include("home.php");
              }
          
          ?>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
