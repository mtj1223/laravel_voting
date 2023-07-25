<?php

namespace App\Http\Controllers;

use App\Models\Votes;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    //

    public function index(){

        $votes = Votes::all();
        return view('voting',['projects'=>$votes]);
    }
    public function vote(Request $request){

        $project_id = $request->input('project_id');
        $option = $request->input('option');

        $project = Votes::find($project_id);
        if($project){
            if($option == 'up'){
                $project->upvotes += 1;
            }
            else{
                $project->downvotes += 1;
            }
            $project->save();
        }
        else{
            return response("Not Found",404);
        }

        return "Vote Received";
    }


}
