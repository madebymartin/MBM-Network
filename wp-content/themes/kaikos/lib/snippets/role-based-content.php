<!-- ROLE BASED CONTENT -->



<!-- ADMINISTRATOR CONTENT -->

<?php if ( current_user_can('trade-customer') ) {?> 

<!-- Content here will appear only to administrator -->


<?php } else { ?>

<!-- Content here will appear to anyone else -->


<?php } ?>
<?php endwhile; ?>
