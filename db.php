<?php
   $con=mysql_connect("localhost","kostin","mAGEIN");
   mysql_query(" SET NAMES 'utf8' ");
   $db=mysql_select_db("db_kostin");
   if(!$con || !$db)
   {
     exit(mysql_error());
   }