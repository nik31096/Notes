<html>
  <head>
    <link type="text/css" rel="stylesheet" href="registration.css" />
    <meta charset="utf-8">
    <title>Регистрация</title>
  </head>
  <body>
    <h1 id="title">Регистрация</h1><br /><br />
    
    <form id="form" method="POST" action="registration.php">
      <p class="text">Логин: </p><input class="input" type="text" name="login" required placeholder="Заполните это поле" /><br /><br />
      <p class="text">Пароль: </p><input class="input" type="text" name="password" required placeholder="Заполните это поле" /><br /><br />
      <input type="hidden" name="date" value="<?php date("Y-m-d"); ?>"/>
      <input type="hidden" name="time" value="<?php date("H:i:s"); ?>"/>
      <input type="submit" name="registration" value="Зарегистрироваться" />
    </form>
    <?php
        error_reporting( E_ERROR );
        $login=strip_tags(trim($_POST['login']));
        $password=strip_tags(trim($_POST['password']));
        $time=$_POST['time'];
        $date=$_POST['date'];
        include_once("db.php");
        $result=mysql_query(" 
                             SELECT * FROM users
        ");
        while($row=mysql_fetch_array($result)) {
           if($row['login']==$login) {
             ?>
             <p class="end" >Пользователь с таким именем уже существует<br /> Выберете другой логин<br />
             Если Вы уже зарегистрированы, то нажмите<a href='enter.php'> сюда</a></p><?php
             die();
           }
        }
        if(isset($_POST['registration'])) {
        mysql_query("  
                       INSERT INTO users (login,password,date,time)
                       VALUES('$login','$password','$date','$time')
        ");
       
        mysql_query("
                        CREATE TABLE `db_kostin`.`$login$password` 
                       ( `id` INT NOT NULL AUTO_INCREMENT , 
                       `title` VARCHAR(80) NOT NULL, `date` DATE NOT NULL, 
                       `time` TIME NOT NULL, `note` TEXT NOT NULL, 
                       PRIMARY KEY (`id`)) ENGINE = InnoDB;
                       
        ");
        mysql_close();
        echo "<p class='end'>Вы успешно зарегистрированы</p><br />";
        echo "<p class='end'>Нажмите </p>"; ?><a class='end' href="enter.php">сюда</a><?php echo "<p class='end'> чтобы войти</p>";
        }
    ?>
    <br /><br />
    <p class="end"> Если Вы уже зарегистрированы, то нажмите <a  href="enter.php">сюда</a></p>
  </body>
</html>
