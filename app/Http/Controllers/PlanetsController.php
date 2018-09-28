<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planet;
use App\Http\Resources\Planets as PlanetsResource;
use GuzzleHttp\Client;

class PlanetsController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $planets = Planet::where('name','like', '%'.$request->search.'%')->get();
            foreach($planets as $planet){
                $http = new Client;
                $swapi = $http->get('https://swapi.co/api/planets/?search='.$planet->name);
                $response = json_decode((string) $swapi->getBody(), true);
                $results = $response['results'];
                foreach ($results as $result){
                    foreach ($result as $key=>$value){
                        if($key == 'films'){
                    
                            $planet->films = count($value);
                        }
                    }
                }
            }
            if($planets->count()>0){
                return ["data" => $planets];
            } else {
                return ["message" => "Maybe Death Star already destroyed this planet"];
            }
        }
        return new PlanetsResource(Planet::paginate(15));
        
    }

    public function store(Request $request)
    {
        $planet = new Planet();
        
        $planet->fill($request->all());
        $this->countId($planet);
        $planet->save();

        return response()->json(["data" => $planet],201);
    }

    private function countId($planet)
    {
        $planets = new PlanetsResource(Planet::paginate(1));
        if ($planets->total() > 0){
            $planet->_id = $planets->total()+1;
        }
        
    }

    public function show($id)
    {
        $planet = Planet::find((int)$id);
        if($planet)
            return $planet;
        return response()->json(['message' => 'Planet not found'], 404);
    }

    public function destroy($id){
        $planet = Planet::find((int)$id);
        if($planet){
            $planet->delete();
            return response()->json(['message' => 'Planet destroyed by Death Star'], 200);
        }
        else{
            return response()->json(['message' => "Death Star missed the shot"], 404);
        }
    }
}
