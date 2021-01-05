<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
class VoteController extends Controller
{
    //
    public function vote(Request $request){
        $personId = $request->personId;
        $ipAddress = $request->ipAddress;
        $vote = Vote::where('ipaddress','=',$ipAddress)->first();
        if($vote == null){
            $vote = Vote::create([
                'personid' => $personId,
                'ipaddress' => $ipAddress
            ]);
            return response([
                'success' => true,
                'message' => 'Vote has been sent',
            ],200);
        }else{
            if($vote->personid == $personId){
                return response([
                    'success' => false,
                    'message' => 'You have already voted, one vote per ip address'
                ],401);
            }else{
                $vote->personid = $personId;
                $vote->save();
                return response([
                    'success' => false,
                    'message' => 'Your vote has changed'
                ],200);
            }
        }
    }
}
