<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        
        return $user;
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return $user;
    }

    public function login(Request $request){
        $authen = $request->only('email', 'password'); 
        if(Auth::attempt($authen)){
            // $request->session()->regenerate(); // Làm mới session để ngăn chặn tấn công giả mạo
            // $request->session()->put('user', Auth::user());
            // $token = $request->user()->createToken($request->token_name);
            
            // return  response()->json(['user' => Auth::user()->createToken()], 200);
            // return ['token' => $token->plainTextToken];

            $user = Auth::user();
            // Tạo và trả về token
            $token = $user->createToken('auth-token')->plainTextToken;
    
            return response()->json(['token' => $token]);
        }
        else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    public function logout(Request $request){
        // $authorizationHeader = $request->header('Authorization');
        // $token_key = DB::table('personal_access_tokens')->where('token' , '==', $authorizationHeader)->delete();
        // // $user->tokens()->where('id', $tokenId)->delete();
        // // return $authorizationHeader;
        // return response()->json(['message' => 'Đăng xuất thành công']);
        // Lấy thông tin user đang đăng nhập
        $user = Auth::user();
        
        // Xóa tất cả các token liên kết với user hiện tại
        $user->tokens()->delete();
        
        // Trả về thông báo đăng xuất thành công hoặc chuyển hướng tùy theo yêu cầu
        return response()->json(['message' => 'Đăng xuất thành công']);
        
        
       
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return 204; // No content
    }
}
