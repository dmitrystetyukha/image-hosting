<?php
namespace app\view;

class UserView
{
    public static function getLoginForm()
    {
        $action    = $_SERVER['PHP_SELF'];
        $csrfToken = $_SESSION['csrf_token'];

        echo <<<LOGINFORM
        <form method="post" action="$action">
            <label for="username">Имя:</label>
            <input type="text" id="username" name="username"><br>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password"><br>

            <input type="hidden" name="csrf_token" value="$csrfToken">

            <input type="submit" value="Войти">
        </form>
        <h3><a href="/register">Нет аккаунта. Зарегистрировать.</a></h3>
        LOGINFORM;
    }

    public static function getRegisterForm()
    {
        $action    = $_SERVER['PHP_SELF'];
        $csrfToken = $_SESSION['csrf_token'];

        echo <<<REGISTERFORM
        <form method="post" action="$action">
            <label for="username">Имя:</label>
            <input type="text" id="username" name="username"><br>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password"><br>

            <label for="password2">Пароль еще раз:</label>
            <input type="password" id="password2" name="password2"><br>

            <input type="hidden" name="csrf_token" value="$csrfToken">

            <input type="submit" value="Зарегистрироваться">
        </form>
        <h3><a href="/login">Есть аккаут. Войти</a></h3>
        REGISTERFORM;

    }
}