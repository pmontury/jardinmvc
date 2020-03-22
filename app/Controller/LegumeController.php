<?php

namespace App\Controller;

use App\Weblitzer\Controller;
use App\Weblitzer\Database;
use App\Weblitzer\View;
use App\Model\LegumeModel;
use App\Service\Form;
use App\Service\Validation;

use JasonGrimes\Paginator;

/**
 *
 */
class LegumeController extends Controller
{
   public function listelegumes($page)
   {  $view = new View();
      $titre = 'Liste des légumes';
      $totalItems =  LegumeModel::count();
      $itemsPerPage = 3;
      $currentPage = 1;
      $offset = 0;
      $currentPage = $page;
      $offset = ($currentPage - 1) * $itemsPerPage;
      $urlPattern = $view->path('listelegumes') . '/(:num)/';
      $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

      $legumes = LegumeModel::allByPage($itemsPerPage, $offset, 'nom');

      $this->render('app.legume.listelegumes',array(
         'titre'     => $titre,
         'legumes'   => $legumes,
         'total'     => $totalItems,
         'paginator' => $paginator,
      ));
   }

   public function detaillegume($id)
   {  $titre = 'Détails d\'un légume';
      $legume = LegumeModel::findById($id);
      if (empty($legume))
      {  // si le légume n'existe pas dans la BDD => error 404
         $this->Abort404();
      }
      $this->render('app.legume.detaillegume',array(
         'titre' => $titre,
         'legume' => $legume
      ));
   }

   public function addlegume()
   {  $titre = 'Ajouter un légume';
      $errors = array();
      $validFile = array();

      if (!empty($_POST['submitted']))
      {  $post = $this->cleanXss($_POST);
         $validation = new Validation();
         $photoMandatory = true;

         $errors['nom'] = $validation->textValid($post['nom'], 'nom', 3, 100);
         $errors['description'] = $validation->textValid($post['description'], 'description', 3, 1000);
         $validFile = $validation->fileValid($errors, 'photo', $photoMandatory);

         $errors = $validFile['errors'];
         $nameOriginal = $validFile['nameOriginal'];
         $ext = $validFile['ext'];

         if($validation->IsValid($errors))
         {  if ($photoMandatory)
            {  $photoDir = 'C:\xampp\htdocs\php-phil\jardinmvc\public\asset\img\\';
               $newFileName = date('Y_m_d_H_i') . '_' . $nameOriginal . '.' . $ext;
               // if (!is_dir($photoDir))
               // {  mkdir($photoDir);
               // }
               $photo = $photoDir . $newFileName;
               if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo))
               {  $errors['photo'] =  'Erreur lors de l\'upload';
               }
            }
            else
            {  $newFileName = NULL;
            }
         }

         if($validation->IsValid($errors))
         {  $bdd = new Database('jardin');
            $sql = "INSERT INTO t_legumes VALUES (?,?,?,?,?)";
            $bind = array(NULL, $post['nom'], $post['description'], $newFileName, date('Y-m-d H:i:s'));
            $bdd->prepareInsert($sql, $bind);
            $this->redirect('listelegumes', array(1));
         }
      }

      $form = new Form($errors);
      $this->render('app.legume.addlegume',array(
         'titre' => $titre,
         'form' => $form
      ));
   }

   /**
    *
   */
   public function Page404()
   {  $this->render('app.default.404');
   }

} // class LegumeController
