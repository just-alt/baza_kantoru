<?php

namespace app\commands;


use app\rbac\UserGroupRule;
use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;
        $authManager->removeAll();

//        Create Roles
        $guest = $authManager->createRole('guest');
        $manager = $authManager->createRole('manager');
        $admin = $authManager->createRole('admin');

//        Create permisions
        $login = $authManager->createPermission('login');
        $logout = $authManager->createPermission('logout');
        $error = $authManager->createPermission('error');
        $signUp = $authManager->createPermission('sign-up');
        $index = $authManager->createPermission('index');
        $view = $authManager->createPermission('view');
        $create = $authManager->createPermission('create');
        $update = $authManager->createPermission('update');
        $delete = $authManager->createPermission('delete');
        $camera = $authManager->createPermission('camera');
        $search = $authManager->createPermission('search');
        $export = $authManager->createPermission('export');
        $export1 = $authManager->createPermission('export1');
        $price = $authManager->createPermission('price');
        $alt = $authManager->createPermission('alt');

//         Add permissions in Yii::$app->authManager
        $authManager->add($login);
        $authManager->add($logout);
        $authManager->add($error);
        $authManager->add($signUp);
        $authManager->add($index);
        $authManager->add($view);
        $authManager->add($create);
        $authManager->add($update);
        $authManager->add($delete);
        $authManager->add($camera);
        $authManager->add($search);
        $authManager->add($export);
        $authManager->add($export1);
        $authManager->add($price);
        $authManager->add($alt);

//         Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

//        Add rule "UserGroupRule" in roles
        $guest->ruleName = $userGroupRule->name;
        $manager->ruleName = $userGroupRule->name;
        $admin->ruleName = $userGroupRule->name;

//        Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($manager);
        $authManager->add($admin);

//        Add permission-per-role in Yii::$app->authManager
        // Guest
        $authManager->addChild($guest, $login);
        $authManager->addChild($guest, $logout);
        $authManager->addChild($guest, $error);
        $authManager->addChild($guest, $signUp);
        $authManager->addChild($guest, $index);
        $authManager->addChild($guest, $view);
        $authManager->addChild($guest, $price);

        // manager
        $authManager->addChild($manager, $guest);
        $authManager->addChild($manager, $create);
        $authManager->addChild($manager, $update);
        $authManager->addChild($manager, $search);
        $authManager->addChild($manager, $delete);

//        Admin
        $authManager->addChild($admin, $manager);
        $authManager->addChild($admin, $camera);
        $authManager->addChild($admin, $export);
        $authManager->addChild($admin, $export1);
        $authManager->addChild($admin, $alt);
    }

}