<html>
  <head>
    <link type="text/css" rel="stylesheet" href="registration.css" />
    <meta charset="utf-8">
    <title>Вход</title>
  </head>
  <body>
    <?php
      session_start();
    ?>
    <p>
    <form id="form" method="POST" action="enter.php">
      <p class="text">Логин:</p> <input type="text" name="login" required /><br /><br />
      <p class="text">Пароль:</p> <input type="password" name="password" required /><br /><br />
      <input type="submit" name="enter" value="Войти" /><br /><br />
      <p class="end" >Нажмите <a href="registration.php">сюда</a>, если Вы еще не зарегистрированы</p>
    </form>
    <?php
        error_reporting( E_ERROR );
        $login=strip_tags(trim($_POST['login']));
        $password=strip_tags(trim($_POST['password'])); 
        
        include_once("db.php");
        
        $result=mysql_query("  
                               SELECT * FROM users                      
        ");
        if(isset($_POST['enter'])) {
           while($row=mysql_fetch_array($result)) {
            if($login==$row['login'] && $password==$row['password']) {
                 $_SESSION['login']=$login;
                 $_SESSION['password']=$password;
                 ?>
                 <script type="text/javascript">
                   document.location.href="Notes.php";
                 </script><?php
            }
            
          }
           echo "<p class='end' >Неправильно введен логин/пароль</p>"."<br />";
           echo "<p class='end' >Попробуйте снова</p>";
           die();
          
        }
        
        
        
    ?>
  </body>
</html>
 
