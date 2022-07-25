<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']) + ['user_type_id' => 2];

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    }
    public function getRooms(Request $request){

        $request->validate([
            'hotel_id' => 'required|numeric'
        ]);
        $rooms = Room::where('hotel_id',$request->hotel_id);

        if(isset($request->room_name)){
            $rooms = $rooms->where('name','like','%'.$request->room_name.'%');
        }
        if(isset($request->capacity)){
            $rooms = $rooms->where('capacity',$request->capacity);
        }

        $rooms = $rooms->get();

        return response()->json([
            'rooms' => $rooms
        ]);
    }
}
