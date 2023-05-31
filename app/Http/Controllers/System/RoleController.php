<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\AdminController;
use App\Repositories\RoleRepository;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RoleController extends AdminController
{
    private $repo;
    function __construct(RoleRepository $role)
    {
        $this->repo = $role;
    }

    public function index()
    {
        $dataMenu = $this->repo->getListMenu();
        $this->setTitle("Pengaturan Role (Developer Only)");
        $this->content['dataMenu'] = $dataMenu;
        return view('system.role', $this->content);
    }

    public function datatable(Request $request)
    {
        $params = $request->post('datatable');
        $query = Role::query();
        return DataTables::of($query)->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
        ]);

        $result = null;
        if ($request->post('id') != null) {
            $result = Role::where('id', $request->post('id'))
                ->update([
                    'name' => $request->post('name'),
                    'slug' => $request->post('slug'),
                    'description' => $request->post('description'),
                ]);
        } else {
            $result = Role::create([
                'name' => $request->post('name'),
                'slug' => $request->post('slug'),
                'description' => $request->post('description'),
            ])->id;
        }

        return $this->responseJson($result);
    }

    public function destroy(Request $request)
    {
        $id = $request->post('id');
        $result = Role::destroy($id);
        return $this->responseJson(
            $result,
            ($result == 0) ? 'Gagal menghapus data' : 'Data berhasil dihapus',
            ($result == 0) ? 400 : 200,
            ($result == 0) ? 400 : 200
        );
    }
    
    public function getCurrentRoleMenu(Request $request){
        $currenRoleId = $request->roleId;
        $dataRoleMenu = $this->repo->getMenuByRole($currenRoleId);
        return $this->responseJson($dataRoleMenu,"Data menu by Role");
    }

    public function updateCurrentRoleMenu(Request $request){
        $currenRoleId = $request->roleId;
        $currenMenuId = $request->menuId;
        $isAdded     = $request->isAdded;
        $updateProcess = $this->repo->updateRoleMenu($currenMenuId,$currenRoleId,$isAdded);
        $message = "Berhasil Memperbaharui Hak Akses";
        return $this->responseJson(null,"Data menu by Role");
    }
}
