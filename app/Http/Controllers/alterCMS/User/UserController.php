<?php

namespace App\Http\Controllers\alterCMS\User;

use App\AlterBase\Models\User\User;
use App\AlterBase\Repositories\User\RoleRepository;
use App\AlterBase\Repositories\User\UserRepository;
use App\AlterBase\Services\UserVerification;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use Collective\Html\HtmlServiceProvider;
/**
 * Class UserController
 * @package App\Http\Controllers\CMS
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var UserVerification
     */
    private $userVerification;
    /**
     * @var LoggerInterface
     */
    private $log;
    /**
     * @var RoleRepository
     */
    private $role;
    /**
     * @var DatabaseManager
     */
    private $db;

    /**
     * UserController constructor.
     * @param UserRepository $user
     * @param RoleRepository $role
     * @param UserVerification $userVerification
     * @param LoggerInterface $log
     * @param DatabaseManager $db
     */
    public function __construct(UserRepository $user,RoleRepository $role,UserVerification $userVerification,LoggerInterface $log,DatabaseManager $db)
    {
        $this->user = $user;
        $this->userVerification = $userVerification;
        $this->log = $log;
        $this->role = $role;
        $this->db = $db;
    }

    /**
     * Show all the users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view',User::class);

        $users = $this->user->paginate(50);

        return view('cms.users.index')
            ->with('users',$users);
    }

    /**
     * Show form to create new users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create',User::class);
        $roles = $this->role->all();

        return view('cms.users.create')
            ->with('roles',$roles)
            ->with('assignedRoles',[]);
    }

    /**
     * Store newly created user
     *
     * @param UserRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create',User::class);

        try{
            $this->db->beginTransaction();

            $input = $request->only([
                'name','email','password'
            ]);

            $input['active'] = false;
            if($request->active){
                $input['active'] = true;
            }

            if($request->hasFile('profile_image')){
                $input['profile_image'] = $this->uploadImage($request);
            }
            $input['verified'] = true;
            $user = $this->user->store($input);

            $user->roles()->sync($request->roles);

           // $this->userVerification->sendVerificationEmail($user);

            $this->db->commit();

            return redirect()->route('cms::users.index')
                ->with('success',"User created successfully.");

        }catch (\Exception $e){
            $this->db->rollback();
            $this->log->error((string) $e);

            return redirect()->route('cms::users.create')
                ->with('error',"Failed to add user. ".$e->getMessage())
                ->withInput();
        }

    }

    /**
     * Show form to edit user
     *
     * @param User $user
     * @return $this
     */
    public function edit(User $user)
    {
        $this->authorize('update',User::class);

        $roles = $this->role->all();
        $assignedRoles = $user->roles->pluck('id')->toArray();

        return view('cms.users.edit')->with('user',$user)
            ->with('roles',$roles)
            ->with('assignedRoles',$assignedRoles);
    }

    /**
     * Update user data
     *
     * @param UserRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $this->authorize('update',User::class);

        try{
            $this->db->beginTransaction();

            $input = $request->only([
                'name','email'
            ]);

            if($request->hasFile('profile_image')){
                $input['profile_image'] = $this->uploadImage($request);
            }

            if($request->password){
                $input['password'] = $request->password;
            }

            $this->user->update($id,$input);
            $user = $this->user->find($id);

            $user->roles()->sync($request->roles);
//            $this->userVerification->sendVerificationEmail($user);

            $this->db->commit();

            return redirect()->route('cms::users.index')
                ->with('success','User updated successfully.');

        }catch (\Exception $e){
            $this->db->rollback();
            $this->log->error((string) $e);

            return redirect()->route('cms::users.edit',['user'=> $user->id])
                ->with('error','Filed to update user.')
                ->withInput();
        }
    }

    /**
     * Verify user with verification token
     *
     * @param Request $request
     * @param $token
     * @return string
     */
    public function verify(Request $request,$token)
    {
        try{
            if($request->email){
                $this->userVerification->verifyToken($request->email,$token);

                return redirect()->route('login')->with('success',"You are verified");
            }

            return "Invalid verification request.";

        }catch (\Exception $e){
            $this->log->error((string) $e);

            return "Failed to verify.".$e->getMessage();
        }
    }

    /**
     * Upload image
     *
     * @param $request
     * @return string
     */
    private function uploadImage($request)
    {
        $image = $request->file('profile_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('uploads/users/');
        $image->move($destinationPath, $filename);

        return $filename;
    }
}
