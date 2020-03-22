<h1><?= ucfirst($legume->nom); ?></h1>
<div class="detail">
   <img src="<?= $view->asset('img/'.$legume->photo); ?>" alt="photo légume">
</div>
<div class="detail">
   <p class="titredetail">Description</p><p><?= $legume->description; ?></p>
</div>
