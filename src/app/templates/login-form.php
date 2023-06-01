<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
  <label for="username">Имя:</label>
  <input type="text" id="username" name="username"><br>

  <label for="password">Пароль:</label>
  <input type="password" id="password" name="password"><br>

  <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

  <input type="submit" value="Войти">
</form>