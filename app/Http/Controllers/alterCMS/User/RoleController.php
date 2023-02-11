<?php

namespace App\Http\Controllers\alterCMS\User;

use App\AlterBase\Models\User\Module;
use App\AlterBase\Models\User\Role;
use App\AlterBase\Repositories\User\RoleRepository;
use App\Http\Requests\RoleRequest;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\LoggerInterface;

/**
 * Class RoleController
 * @package App\Http\Controllers\CMS
 */
class RoleController extends Controller
{
    /**
     * @var Role
     */
    private $role;
    /**
     * @var LoggerInterface
     */
    private $log;
    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * RoleController constructor.
     * @param Role|RoleRepository $role
     * @param LoggerInterface $log
     * @param DatabaseManager $db
     */
    public function __construct(RoleRepository $role,LoggerInterface $log,DatabaseManager $db)
    {
        $this->role = $role;
        $this->log = $log;
        $this->db = $db;
    }

    /**
     * Show all the roles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //$this->authorize('view',Role::class);

        $roles = $this->role->paginate(15);

        return view('cms.users.roles.index')
            ->with('roles',$roles);
    }

    /**
     * Show form to create new role
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //$this->authorize('create',Role::class);

        return view('cms.users.roles.create');
    }

    /** Store role data
     *
     * @param RoleRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
    {
        //$this->authorize('create',Role::class);

        try {
            $input = $request->only(['name', 'description']);

            $this->role->store($input);

            return redirect()->route('cms::users.roles.index')
                ->with('success', "Role created successfully.");

        } catch (\Exception $e) {
            $this->log->error((string) $e);

            return redirect()->route('cms::users.roles.create')
                ->with('error','Failed to create role.')
                ->withInput();
        }
    }

    /**
     * Show form to edit role
     *
     * @param Role $role
     * @return $this
     */
    public function edit(Role $role)
    {
        //$this->authorize('update',Role::class);

        return view('cms.users.roles.edit')
            ->with('role',$role);
    }

    /**
     * Update role data
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request, Role $role)
    {
        //$this->authorize('update',Role::class);

        try{
            $input = $request->only(['name','description']);

            $this->role->update($role->id,$input);

            return redirect()->route('cms::users.roles.index')
                ->with('success',"Role updated successfully.");

        }catch (\Exception $e){
            $this->log->error((string) $e);

            return redirect()->route('cms::users.roles.edit',['role'=>$role->id])
                ->with('error','Filed to update role')
                ->withInput();
        }
    }

    /**
     * Assign permissions to the specific role
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permissions(Role $role)
    {
        //$this->authorize('permissions',Role::class);

        $modules = Module::all();

        return view('cms.users.roles.permissions')
            ->with('role',$role)
            ->with('modules',$modules);
    }

    /**
     * Update permissions for the given role
     *
     * @param Role $role
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePermissions(Role $role, Request $request)
    {
        //$this->authorize('permissions',Role::class);

        try{
            $this->db->beginTransaction();

            $modules = $request->modules;

            $role->modules()->sync($modules?array_values($modules):[]);

            $role->permissions()->sync(array_keys($request->except(['_method', '_token','modules'])));

            $this->db->commit();

            return redirect()->route('cms::users.roles.index')
                ->with('success','Permissions updated successfully.');

        }catch (\Exception $e){
            $this->db->rollback();
            $this->log->error((string) $e);

            return redirect()->route('cms::users.roles.permissions',['role' => $role->id])
                ->with('error','Failed to update permissions.');
        }
    }
}
