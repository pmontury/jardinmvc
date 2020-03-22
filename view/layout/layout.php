<!DOCTYPE html>
<html lang="fr" dir="ltr">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Le jardin en MVC</title>
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="<?= $view->asset('css/reset.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?= $view->asset('css/foundation-icons.css'); ?>">
      <link rel="stylesheet" type="text/css" href="<?= $view->asset('css/style.css'); ?>">
   </head>
   <body>
      <header>
         <div class="wrap position">
            <nav>
                <ul>
                    <li><a href="<?= $view->path('home'); ?>">Home</a></li>
                    <li><a href="<?= $view->path('listelegumes', array(1)); ?>">Liste des légumes</a></li>
                    <li><a href="<?= $view->path('addlegume'); ?>">Ajouter un légme</a></li>
                </ul>
            </nav>
         </div>
      </header>

      <div class="container wrap">
         <?= $content; ?>
      </div>

      <footer>
         <div class="wrap position">
            <p>&copy; <?= date('Y'); ?> Le jardin - MVC</p>
         </div>
      </footer>

      <script src="<?= $view->asset('js/main.js'); ?>"></script>
   </body>
</html>
