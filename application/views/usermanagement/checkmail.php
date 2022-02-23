<?php

 $echeck="select email from users where email=".$_POST['email'];
   $echk=mysql_query($echeck);
   $ecount=mysql_num_rows($echk);
  if($ecount!=0)
   {
      echo "Email already exists";
      return "true";
   }
   ?>