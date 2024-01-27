<?php

namespace iteos\Http\Controllers\Apps;

use Illuminate\Http\Request;
use iteos\Http\Controllers\Controller;
use iteos\Models\User;
use iteos\Models\Warehouse;
use iteos\Models\Division;
use iteos\Models\Status;
use iteos\Models\UserWarehouse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Hash;
use DB;
use Auth;

class UserManagementController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:Can Access Users');
         $this->middleware('permission:Can Create User', ['only' => ['create','store']]);
         $this->middleware('permission:Can Edit User', ['only' => ['edit','update']]);
         $this->middleware('permission:Can Delete User', ['only' => ['destroy']]);
    }

    public function userIndex()
    {
        $users = User::where('email','!=','api@local.com')->orderBy('name','asc')
                        ->get();
        $roles = Role::pluck('name','name')->all();
        
        return view('apps.pages.users',compact('users','roles'));
    }

    public function userProfile()
    {
        $user = Auth::user();
        $locations = Auth::user()->warehouses;
        return view('apps.pages.profile',compact('user','locations'));
    }

    public function userStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        
        $log = 'User '.($user->name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Created',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function userShow($id)
    {
        $user = User::find($id);
        return view('apps.show.users',compact('user'))->renderSections()['content'];
    }

    public function userEdit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        
        return view('apps.edit.users',compact('user','roles','userRole'))->renderSections()['content'];
    }

    public function userUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all(); 
        
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }
        $user = User::find($id);
        $user->update($input);
        
        DB::table('model_has_roles')->where('model_id',$id)->delete();        
        $user->assignRole($request->input('roles'));
        
        $log = 'User '.($user->name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Updated',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($notification);
    }

    public function updateAvatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,JPG,gif,svg|dimensions:width=150,length=150',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('public/avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save(); 

        $log = 'User Picture '.($user->name).' Stored';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User Picture '.($user->name).' Stored',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }

        $user = Auth::user();
        $user->update($input);

        $log = 'Password for User '.($user->name).' Changed';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Password for User '.($user->name).' Changed',
            'alert-type' => 'success'
        );
        return back()
            ->with($notification);
    }

    public function userSuspend($id)
    {
        $input = ['status_id' => '82e9ec8c-5a82-4009-ba2f-ab620eeaa71a'];
        $user = User::find($id);
        $user->update($input);
        
        $log = 'User '.($user->name).' Suspended';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Suspended',
            'alert-type' => 'success'
        );
        return redirect()->route('user.index')
                        ->with($notification);
    }

    public function userDestroy($id)
    {
        $user = User::find($id);
        
        $log = 'User '.($user->name).' Dihapus';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'User '.($user->name).' Dihapus',
            'alert-type' => 'success'
        );
        $user->delete();
        return redirect()->route('user.index')
                        ->with($notification);
    }

    public function roleIndex(Request $request)
    {
        $permission = Permission::get();
        $roles = Role::orderBy('id','ASC')->get();
        return view('apps.pages.roles',compact('roles','permission'));
    } 

    public function roleCreate()
    {
        return view('apps.input.roles');
    }

    public function roleStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);


        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        $log = 'Access Role '.($role->name).' Created';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Access Role '.($role->name).' Created',
            'alert-type' => 'success'
        ); 

        return redirect()->route('role.index')
                        ->with($notification);
    }

    public function roleShow($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();


        return view('apps.show.roles',compact('role','rolePermissions'))->renderSections()['content'];
    }

    public function roleEdit($id)
    {
        $data = Role::find($id);
        $permission = Permission::get();
        $roles = Role::join('role_has_permissions','role_has_permissions.role_id','=','roles.id')
                       ->where('roles.id',$id)
                       ->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            /*->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')*/
            ->get();
        
        return view('apps.edit.roles',compact('data','rolePermissions','roles'));
    }

    public function roleUpdate(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));
        $log = 'Access Role '.($role->name).' Updated';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Access Role '.($role->name).' Updated',
            'alert-type' => 'success'
        ); 

        return redirect()->route('role.index')
                        ->with($notification);
    }

    public function roleDestroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        $log = 'Access Role '.($role->name).' Deleted';
         \LogActivity::addToLog($log);
        $notification = array (
            'message' => 'Access Role '.($role->name).' Deleted',
            'alert-type' => 'success'
        ); 
        return redirect()->route('role.index')
                        ->with($notification);
    }
}
