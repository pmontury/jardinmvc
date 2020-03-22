<h1>
   <?= $titre; ?>
</h1>
<form action="" method="post" enctype="multipart/form-data">
   <?= $form->label('Nom'); ?>
   <?= $form->input('nom'); ?>
   <?= $form->error('nom'); ?>

   <?= $form->label('Description'); ?>
   <?= $form->textarea('description', null, 10); ?>
   <?= $form->error('description'); ?>

   <?= $form->label('Photo'); ?>
   <?= $form->file('photo'); ?>
   <?= $form->error('photo'); ?>

   <?= $form->submit(); ?>
</form>
