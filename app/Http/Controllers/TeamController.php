<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $teams = $request->user()->teams()->get();
        return response()->json($teams);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'base_location' => 'nullable|string|max:255',
            'team_principal' => 'nullable|string|max:255',
            'chassis' => 'nullable|string|max:255',
            'engine_supplier' => 'nullable|string|max:255',
            'founded_date' => 'nullable|date',
            'logo' => 'nullable|string|max:255',
            'total_points' => 'nullable|integer',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $team = $request->user()->teams()->create([
            'name' => $request->name,
            'country' => $request->country,
            'base_location' => $request->base_location,
            'team_principal' => $request->team_principal,
            'chassis' => $request->chassis,
            'engine_supplier' => $request->engine_supplier,
            'founded_date' => $request->founded_date,
            'logo' => $request->logo,
            'total_points' => $request->total_points,
            'user_id' => $request->user_id ?? $request->user()->id,
        ]);

        return response()->json($team, 201);
    }

    public function update(Request $request, $id)
    {
        $team = $request->user()->teams()->findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|nullable|string|max:255',
            'base_location' => 'sometimes|nullable|string|max:255',
            'team_principal' => 'sometimes|nullable|string|max:255',
            'chassis' => 'sometimes|nullable|string|max:255',
            'engine_supplier' => 'sometimes|nullable|string|max:255',
            'founded_date' => 'sometimes|nullable|date',
            'logo' => 'sometimes|nullable|string|max:255',
            'total_points' => 'sometimes|nullable|integer',
        ]);

        $team->update($request->only([
            'name',
            'country',
            'base_location',
            'team_principal',
            'chassis',
            'engine_supplier',
            'founded_date',
            'logo',
            'total_points',
        ]));

        return response()->json($team);
    }

    public function search(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $teams = $request->user()->teams()
            ->where('name', 'LIKE', '%' . $request->name . '%')
            ->get();

        return response()->json($teams);
    }

    // delete
    public function destroy(Request $request, $id)
    {
        $team = $request->user()->teams()->findOrFail($id);
        $team->delete();

        return response()->json(null, 204);
    }
}
