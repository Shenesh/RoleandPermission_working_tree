<?php
namespace App\Http\Controllers;
use App\Role;
use App\User;
use DataTables;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::orderBy('id', 'desc')->get();
        

        return view('admin.users.index',compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->ajax()){
            //return response()->json(['test'=>'test_data']);
            $roles = Role::where('id',$request->role_id)->first(); 
            $permissions = $roles->permissions;
            return response()->json(['permissions'=>$permissions]);

        }
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.create',compact('roles','permissions'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required',
            'password'=>'required|between:8,255|confirmed',
            'password_confirmation'=>'required'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        if($request->role != null){
            $user->roles()->attach($request->role);
            $user->save();
        }
        if($request->permissions != null){            
            foreach ($request->permissions as $permission) {
                $user->permissions()->attach($permission);
                $user->save();
            }
        }
        return redirect()->route('users.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        $userRole = $user->roles->first();
        if($userRole != null){
            $rolePermissions = $userRole->allRolePermissions;
        }else{
            $rolePermissions = null;
        }
        $userPermissions = $user->permissions;

        // dd($rolePermission);

        return view('admin.users.edit', [
            'user'=>$user,
            'roles'=>$roles,
            'userRole'=>$userRole,
            'rolePermissions'=>$rolePermissions,
            'userPermissions'=>$userPermissions
            ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
               //validate the fields
               $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'confirmed',
            ]);
    
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->password != null){
                $user->password = Hash::make($request->password);
            }
            $user->save();
    
            $user->roles()->detach();
            $user->permissions()->detach();
    
            if($request->role != null){
                $user->roles()->attach($request->role);
                $user->save();
            }
    
            if($request->permissions != null){            
                foreach ($request->permissions as $permission) {
                    $user->permissions()->attach($permission);
                    $user->save();
                }
            }
    
            return redirect('/users');
    
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();

        return redirect('/users');
    }
    public function get_all_users(){
        $users = User::all();
        // $roles = Role::all();
        // $permissions = Permissions::all();
        // or you can run a complex join operation to obtain data.
        return Datatables::of($users)
        ->addColumn('action', function ($users) {
            $buttons ='<a class="btn btn-info btn-sm" href="'.url('/user/'.$users->id.'/').'">View</a> 
            <a class="btn btn-sm btn-success btn-rounded m-b-1 m-l-5" href="'.url('/user/'.$users->id.'/edit').'">Edit</a>
            <input type="hidden" id="hiddenID" value="'.$users->id.'">
            <button data-token="'. csrf_token() .'" class="btn btn-sm btn-danger btn-rounded m-b-1 m-l-5" id="delete">Delete</button>';
            return $buttons;
        })
        ->make(true);
    }
}
