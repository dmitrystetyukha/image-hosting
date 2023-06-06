<?php
namespace app;

use app\controller\CommentController;
use app\controller\PictureController;
use app\controller\UserController;

use app\view\UserView;

class Router
{

    private array $routes = [
        'GET'  => ['/', '/register', '/login', '/picture-detail'],
        'POST' => ['/register', '/login', '/logout', '/upload-picture', '/add-comment', '/edit-comment', '/delete-comment']
    ];

    private UserController $userController;
    private PictureController $pictureController;
    private CommentController $commentController;

    public function __construct(UserController $userController, PictureController $pictureController, CommentController $commentController)
    {
        $this->userController    = $userController;
        $this->pictureController = $pictureController;
        $this->commentController = $commentController;
    }

    public function get404()
    {
        require __DIR__ . '/templates/404.php';
    }
    public function get400()
    {
        require __DIR__ . '/templates/400.php';
    }

    public function getResponse()
    {
        $uri    = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            switch ($uri) {
                case ('/'):
                    return $this->pictureController->getPictureList();
                case ('/login'):
                    return UserView::getLoginForm();
                case ('/register'):
                    return UserView::getRegisterForm();
            }
        }
        elseif ($method === 'POST') {
            switch ($uri) {
                case ('/'):
                    return $this->pictureController->getPictureList();
                case ('/login'):
                    UserView::getLoginForm();
                case ('/register'):
                    UserView::getRegisterForm();
            }
        }
        else {
            require_once __DIR__ . '/templates/404.php';
        }
    }
}