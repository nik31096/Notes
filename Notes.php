<html>
 <head>
   <meta charset="UTF-8">
   <title>Мои Заметки</title>
   <link rel="shortcut icon" href="" />
   <link type="text/css" rel="stylesheet" href="notes.css" />
 </head>
 <body>
   <?php
      session_start();
      //error_reporting( E_ERROR );
      include_once("db.php");
      $base=$_SESSION['login'].$_SESSION['password'];
      $result=mysql_query("
                            SELECT * FROM {$base}
      ");
      
      // Вывод всех заметок пользователя на экран
      
      while($row=mysql_fetch_array($result,MYSQL_BOTH)) { 
      
   ?>
   <h1 class="title_note_datetime" ><?php echo $row['title'] ?></h1>
   <h2 class="title_note_datetime" ><?php echo $row['note']; ?></h2>
   <p class="title_note_datetime" ><?php echo $row['date']; ?>   <?php echo $row['time'];?></p>
   <a href="Notes.php?id=<?php echo $row['id']; ?>">Удалить заметку</a>
   <?php 
        if($_GET['id']) {  
              $id = $_GET['id'];
        
              mysql_query("
                           DELETE FROM {$base} WHERE {$base}.`id`={$id}
             ");
             $_GET['id']=0;
             echo "<meta http-equiv='refresh' content='0'>";
             }
   ?>
   <button id="edit" >Редактирование заметки</button>
   <hr />
   <?php 
      //  Конец while 
       }
   ?>
   <p class="text">Добавление новой заметки</p>
   <form id="form" method="POST" action="Notes.php">
      <label class="text">Тема заметки</label><br />
      <input class="input" type="text" name="title1" /><br />
      <label class="text">Текст заметки</label><br />
      <textarea class="input" cols="40" rows="10" name="note1"></textarea><br /><br />
      <input type="hidden" name="date1" value="<?php echo date('Y-m-d'); ?>" />
      <input type="hidden" name="time1" value="<?php echo date('H:i:s'); ?>" />
      <input id="submit" type="submit" name="add" value="Добавить" />
   </form>
   
   <?php
      if(isset($_POST['add'])) {
      $title1=strip_tags(trim($_POST['title1']));
      $date1=$_POST['date1'];
      $time1=$_POST['time1'];
      $note1=strip_tags(trim($_POST['note1']));
 
      mysql_query("
             INSERT INTO {$base}(title,time,date,note)
             VALUES ('$title1','$time1','$date1','$note1')
      ");
      mysql_close();
                 /*<script type="text/javascript">
                   document.location.href="Notes.php";
                 </script><?php*/
      echo "<meta http-equiv='refresh' content='0'>";
      }
   
   ?>

 </body>
</html>