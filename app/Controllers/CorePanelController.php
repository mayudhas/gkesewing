<?php

namespace App\Controllers;

use App\Models\MenusModel;

class CorePanelController extends BaseController
{

    protected $pathViews;

    public function render(string $path, ?array $datas = []): string
    {
        $this->view->setData($datas, 'raw');
        $this->view->setVar('menus', $this->generateMenu(), 'raw');
        return $this->view->render("{$this->pathViews}{$path}");
    }

    public function generateMenu(): array
    {
        $userModel = new MenusModel();
        $rawMenus = $userModel->orderBy('menu_sort', 'ASC')->findAll();
        $menus = [];
        foreach ($rawMenus as $menu)
            if ($menu['menu_parent'] == 0) {
                $childs = [];
                foreach ($rawMenus as $menuChild)
                    if ($menu['menu_id'] === $menuChild['menu_parent'])
                        $childs[] = $menuChild;
                $menu['childs'] = $childs;
                $menus[] = $menu;
            }
        return $menus;
    }

}