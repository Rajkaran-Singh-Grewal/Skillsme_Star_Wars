<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class PeopleController extends Controller
{
    //
    /**
     * Get all Characters from Starwars according to the api
     */
    public function getAllCharacters(){
        $response = json_decode(file_get_contents("https://swapi.dev/api/people"));
        $response_count = $response->count;
        $people = new People;
        Schema::dropIfExists($people->getTableName());
        Schema::create($people->getTableName(), function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('height');
            $table->string('mass');
            $table->string('hair_color');
            $table->string('skin_color');
            $table->string('eye_color');
            $table->string('birth_year');
            $table->string('gender');
            $table->rememberToken();
            $table->timestamps();
        });
        for($i = 1; $i <= ($response_count + 1); $i++){
            try{
                $result = json_decode(file_get_contents("https://swapi.dev/api/people/$i"));
                echo json_encode($result) . "<br>";
                People::create([
                    "name"       => $result->name,
                    "height"     => $result->height,
                    "mass"       => $result->mass,
                    "hair_color" => $result->hair_color,
                    "skin_color" => $result->skin_color,
                    "eye_color"  => $result->eye_color,
                    "birth_year" => $result->birth_year,
                    "gender"     => $result->gender
                ]);
            }catch(\Exception $e){
                echo "$i does not exist";
            }
        }
        return response([
            "success" => true,
            "message" => "All Characters add successfully"
        ],200);
    }
}
