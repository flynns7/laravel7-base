<?php

namespace Modules\System\Repositories;

use App\Models\Menu;

class RoleRepository
{
    public function getListMenu()
    {
        $query = Menu::query()->select('*', 'parent as pid')->with('parent');
        // $query->where('manageable', true);
        $listMenu = $query->get()->toArray();
        $listFirstParent = array_reduce($listMenu, function ($acc, $item) {
            if ($item['parent'] == null)
                array_push($acc, $item);
            return $acc;
        }, []);
        $listChildren   = array_reduce($listMenu, function ($acc, $item) {
            if ($item['parent'] != null)
                array_push($acc, $item);
            return $acc;
        }, []);

        return array("listFirstParent" => $listFirstParent, "listChildren" => $listChildren);
    }

    public function getMenuByRole($roleId)
    {
        $query      = Menu::query()->select('*', 'parent as pid')->with('parent');
        $query->where('manageable', true);
        $listMenu   = $query->get()->toArray();
        $mappedMenu = array_map(function ($item) {
            $item['role_ids'] = explode(",", $item['role_ids']);
            return $item;
        }, $listMenu);

        return array_reduce($mappedMenu, function ($acc, $item) use ($roleId) {
            if (in_array($roleId, $item['role_ids'])) {
                $item['role_ids'] = $roleId;
                array_push($acc, $item);
            }
            return $acc;
        }, array());
    }

    public function updateRoleMenu($menuId, $roleId, $isAdded)
    {
        $dataMenu   = $this->getMenuData($menuId);
        $roleIds    = $this->generateRoleIds($dataMenu->role_ids, $roleId, $isAdded);
        $isUpdatedMenu = Menu::where("id", $menuId)->update(["role_ids" => implode(",", $roleIds)]);

        $dataParent = $this->getMenuData($dataMenu->parent);
        $roleIds    = $this->generateRoleIds($dataParent->role_ids, $roleId, $isAdded);
        if ($this->isChildrenEmpty($dataParent->id, $roleId) && $isAdded === "false")
            $isUpdatedParent = Menu::where("id", $dataParent->id)->update(["role_ids" => implode(",", $roleIds)]);
        else if ($isAdded === "true")
            $isUpdatedParent = Menu::where("id", $dataParent->id)->update(["role_ids" => implode(",", $roleIds)]);

        $isUpdatedLastParent = true;
        if ($dataParent->parent !== 0) {
            $dataParent = $this->getMenuData($dataParent->parent);
            $roleIds    = $this->generateRoleIds($dataParent->role_ids, $roleId, $isAdded);
            if ($this->isChildrenEmpty($dataParent->id, $roleId) && $isAdded === "false")
                $isUpdatedLastParent = Menu::where("id", $dataParent->id)->update(["role_ids" => implode(",", $roleIds)]);
            else if ($isAdded === "true")
                $isUpdatedLastParent = Menu::where("id", $dataParent->id)->update(["role_ids" => implode(",", $roleIds)]);
        }
        if ($isUpdatedMenu && $isUpdatedParent && $isUpdatedLastParent)
            return true;
        return false;
    }

    private function isChildrenEmpty($parentId, $roleId)
    {
        $dataMenu       = Menu::where("parent", $parentId)->get();

        $menuCounted    = 0;
        if (count($dataMenu) > 0) {
            foreach ($dataMenu as $item) {
                if (in_array($roleId, explode(",", $item->role_ids)))
                    $menuCounted++;
            }
        }
        if ($menuCounted === 0)
            return true;
        return false;
    }

    private function getMenuData($id)
    {
        return Menu::query()
            ->select('*', 'parent as pid')
            ->where("id", $id)
            ->first();
    }

    private function generateRoleIds($dataRoleIds, $roleId, $isAdded)
    {
        $roleIds = explode(",", $dataRoleIds);
        if ($isAdded === "true") {
            if (($key = array_search($roleId, $roleIds)) === false)
                array_push($roleIds, $roleId);
        } else {
            if (($key = array_search($roleId, $roleIds)) !== false) {
                unset($roleIds[$key]);
            }
        }

        return $roleIds;
    }
}
