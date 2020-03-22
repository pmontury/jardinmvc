<?php
namespace App\Service;

class Validation
{
    protected $errors = array();

    public function IsValid($errors)
    {
        foreach ($errors as $key => $value) {
            if(!empty($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * emailValid
     * @param email $email
     * @return string $error
     */

    public function emailValid($email)
    {
        $error = '';
        if(empty($email) || (filter_var($email, FILTER_VALIDATE_EMAIL)) === false) {
            $error = 'Adresse email invalide.';
        }
        return $error;
    }

    /**
     * textValid
     * @param POST $text string
     * @param title $title string
     * @param min $min int
     * @param max $max int
     * @param empty $empty bool
     * @return string $error
     */

   public function textValid($text, $title, $min = 3,  $max = 50, $empty = true)
   {
      $error = '';
      if (!empty($text)) {
         $strtext = mb_strlen($text);
         if ($strtext > $max) {
            $error = 'Votre ' . $title . ' est trop long.';
         } elseif($strtext < $min) {
            $error = 'Votre ' . $title . ' est trop court.';
         }
      } else {
         if($empty) {
            $error = 'Veuillez renseigner un ' . $title . '.';
         }
      }
      return $error;
   }

   function fileValid($errors, $key, $obligatoire = true, $maxSize = 2000000, $validExtensions = array('jpg','jpeg','png','gif'), $validMimetypes = array('image/jpeg','image/png','image/jpg','image/gif'))
   {  $imageIn = $_FILES[$key];
      $ext = '';
      $nameOriginal = '';

      if (empty($imageIn))
      {  if ($obligatoire)
         {  $errors[$key] = 'Veuillez choisir une image';
         }
      }
      else
      {  if ($imageIn['error'] > 0)
         {  if ($imageIn['error'] != 4)
            {  $errors[$key] = 'Erreur fichier ' . $_FILES[$key]['error'];
            }
            else
            {  if ($obligatoire)
               {  $errors[$key] = 'Aucune image n\'a été téléchargée';
               }
            }
         }
         else
         {  $file_name = $imageIn['name']; // le nom du fichier
            $file_size = $imageIn['size']; // taille (peu fiable)
            $file_tmp = $imageIn['tmp_name']; // chemin fichier temporaire
            // verif taille du fichier
            if ($file_size > $maxSize OR filesize($file_tmp) > $maxSize)
            {  $errors[$key] = 'Le fichier est trop gros (max ' . $maxsize . 'o)';
            }
            else
            // les extensions
            {  $path = pathinfo($file_name);
               $ext = $path['extension'];
               $nameOriginal = $path['filename'];
               // verif de l'extension
               if (!in_array($ext, $validExtensions))
               {  $errors[$key] = 'Veuillez télécharger une image de type jpg ou jpeg ou png ou gif';
               }
               else
               // verif du mimetype
               {  $finfo = finfo_open(FILEINFO_MIME_TYPE);
                  $mimeType = finfo_file($finfo, $file_tmp);
                  finfo_close($finfo);
                  if (!in_array($mimeType, $validMimetypes))
                  {  $errors[$key] = 'Veuillez télécharger une image de type jpg ou jpeg ou png ou gif';
                  }
               }
            }
         }
      }
      $data = array(
        'errors'        => $errors,
        'ext'           => $ext,
        'nameOriginal'  => $nameOriginal
      );
      return $data;
   }

}
