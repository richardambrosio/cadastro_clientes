<?php if(!class_exists('Rain\Tpl')){exit;}?><nav aria-label="Navegação">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="<?php echo htmlspecialchars( $route, ENT_COMPAT, 'UTF-8', FALSE ); ?>?page=<?php echo htmlspecialchars( $previous, ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-label="Anterior">
        <span aria-hidden="true">&laquo;</span>
      </a>
      </li>
      <?php $counter1=-1;  if( isset($links) && ( is_array($links) || $links instanceof Traversable ) && sizeof($links) ) foreach( $links as $key1 => $value1 ){ $counter1++; ?>

      <li class="page-item <?php if( $currentPage == $value1["text"] ){ ?>active"<?php } ?>">
        <a class="page-link" href="<?php echo htmlspecialchars( $value1["href"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
      </li>
      <?php } ?>

      <li class="page-item">
      <a class="page-link" href="<?php echo htmlspecialchars( $route, ENT_COMPAT, 'UTF-8', FALSE ); ?>?page=<?php echo htmlspecialchars( $next, ENT_COMPAT, 'UTF-8', FALSE ); ?>" aria-label="Próximo">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<div class="container d-flex justify-content-center">
  <small class="text-muted">
      Mostrando <?php echo htmlspecialchars( $currentRecords, ENT_COMPAT, 'UTF-8', FALSE ); ?> de <?php echo htmlspecialchars( $totalRecords, ENT_COMPAT, 'UTF-8', FALSE ); ?> registros
  </small>
</div>