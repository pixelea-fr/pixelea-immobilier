<div>


    <h1><?php //echo $bien->getTypeBien(); ?></h1>
    <p><?php echo $bien->getDescription(); ?></p>
</pre>Code postal: <?php echo $bien->getCp(); ?></p>
    <p>Ville: <?php echo $bien->getVille(); ?></p>

  <?php  $images= $bien->getImages(); ?>
  <?php foreach($images as $key=>$id):?>
      <?php echo wp_get_attachment_image( $id, "large", false, array("class" => "default") ); ?>
    <?php endforeach; ?>
</div>
<pre><?php // var_dump($bien); ?></pre>

