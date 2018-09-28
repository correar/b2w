<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planet;
use App\Http\Resources\Planets as PlanetsResource;

class PlanetsController extends Controller
{
    public function index()
    {
        return new PlanetsResource(Planet::paginate(15));
        
    }

    public function store(Request $request)
    {
        $planet = new Planet();
        
        $planet->fill($request->all());
        $this->countId($planet);
        $planet->save();

        return response()->json($planet,201);
    }

    private function countId($planet)
    {
        $planets = new PlanetsResource(Planet::paginate(1));
        if ($planets->total() > 0){
            $planet->_id = $planets->total()+1;
        }
        
    }
}
