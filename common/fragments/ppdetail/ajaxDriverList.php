<div class="bd">
  <?php 
  foreach($drivers as $cateName => $files):
  ?>
  <dt>Manual</dt>
  <?php
    foreach($files as $file):
  ?>
  <dd><a target="_blank" href="<?= $file['fileUrl'];?>"><?= $file['description'];?></a></dd>
  <?php
    endforeach;
  endforeach; 
  ?>
</div>