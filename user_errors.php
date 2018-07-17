<?php  

if (count($user_errors) > 0) :

  	 foreach ($user_errors as $error):
  	  <p>
  	  	echo $error
  	  </p>

<?php endif ?>
?>