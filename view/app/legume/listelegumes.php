<h1>
   <?= $titre; ?>
</h1>
   <?= $paginator; ?>
   <table>
      <thead><tr><th class="col1">Nom</th><th>Description</th><th>Action</th></thead>
      <tbody>
<?php foreach ($legumes as $legume) : ?>
         <tr>
            <td><?= ucfirst($legume->nom); ?></td>
            <td><?= $this->truncateString($legume->description, 170); ?></td>
            <td class="colaction">
               <a href="<?= $view->path('detaillegume', array($legume->id)); ?>" title="Voir détails"><i class="fi-eye size-30"></i></a>
            </td>
         </tr>
<?php endforeach; ?>
      </tbody>
   </table>
