<?php
namespace developeruz\easyii_rbac;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\Application;
use yii\web\View;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if (!$app->user->isGuest && strpos($app->request->pathInfo, 'admin') === false && !$app->user->can('admin')) {
            $app->on(Application::EVENT_BEFORE_REQUEST, function () use ($app) {
                $app->getView()->on(View::EVENT_END_BODY, [$this, 'hideToolbar']);
            });
        }
    }

    public function hideToolbar()
    {
        $view = Yii::$app->getView();
        $view->registerJs('$("#easyii-navbar").hide()');
    }
}
