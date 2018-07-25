<?php  

if (count($user_errors) > 0)
{
  	foreach ($user_errors as $error)
  	{
  	  echo $error;
  	  echo "<br>";
  	}
}

?>