<?php
namespace App\Weblitzer;
/**
 *  class View
 *  Helper pour les view
 */
class View
{
   private $confDirectory;

   public function __construct()
   {  $config = new Config();
      $this->confDirectory = $config->get('directory');
   }

    /**
     * @param $link
     * @param $id null
     * @return $data
     */
    public function path($link,$tabs = array())
    {
        if(empty($tabs)) {
            $data = $this->urlBase().$link;
        } else {
            $linkarg = '';
            foreach($tabs as $tab){
                $linkarg .= $tab.'/';
            }
            $data = $this->urlBase().$link.'/'.$linkarg;
        }
        return $data;
    }

    public function urlBase()
    {
        // $config = new Config();
        // $directory = $config->get('directory'). 'public/';
        // return 'http://'.$_SERVER['HTTP_HOST'] . $directory;
        return 'http://'.$_SERVER['HTTP_HOST'] . $this->confDirectory . 'public/';
    }

    public function asset($file)
    {
        return $this->urlBase(). 'asset/'.$file;
    }

   public function fileBase()
   {  return $_SERVER["DOCUMENT_ROOT"] . $this->confDirectory . 'public/';
   }

   public function assetDir($file)
   {  return $this->fileBase() . 'asset/' . $file;
   }

}  // class View
