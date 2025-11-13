<?php

namespace App\Http\Controllers;

use App\Models\Lap;
use App\Models\Race;
use App\Models\Driver;
use App\Models\Team;
use App\Models\Cars;
use Illuminate\Http\Request;

class LapController extends Controller
{
    /**
     * Display a listing of all laps with pagination
     */
    public function index()
    {
        $laps = Lap::with(['race', 'driver', 'team', 'car'])
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $laps->map(fn($lap) => [
                'id' => $lap->id,
                'race_id' => $lap->race_id,
                'race_name' => $lap->race->name ?? null,
                'driver_id' => $lap->driver_id,
                'driver_name' => $lap->driver->first_name . ' ' . $lap->driver->last_name ?? null,
                'lap_number' => $lap->lap_number,
                'team_id' => $lap->team_id,
                'team_name' => $lap->team->name ?? null,
                'car_id' => $lap->car_id,
                'car_number' => $lap->car->car_number ?? null,
                'lap_time' => $lap->lap_time,
                'created_at' => $lap->created_at,
            ]),
            'pagination' => [
                'current_page' => $laps->currentPage(),
                'total' => $laps->total(),
                'last_page' => $laps->lastPage(),
                'from' => $laps->firstItem(),
                'to' => $laps->lastItem(),
            ]
        ]);
    }

    /**
     * Search laps by race, driver, or lap number
     */
    public function search(Request $request)
    {
        $query = $request->query('q', '');

        $laps = Lap::with(['race', 'driver', 'team', 'car'])
            ->where(function ($q) use ($query) {
                $q->whereHas('race', function ($subQ) use ($query) {
                    $subQ->where('name', 'like', '%' . $query . '%');
                })
                ->orWhereHas('driver', function ($subQ) use ($query) {
                    $subQ->where('first_name', 'like', '%' . $query . '%')
                        ->orWhere('last_name', 'like', '%' . $query . '%');
                })
                ->orWhere('lap_number', 'like', '%' . $query . '%');
            })
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $laps->map(fn($lap) => [
                'id' => $lap->id,
                'race_id' => $lap->race_id,
                'race_name' => $lap->race->name ?? null,
                'driver_id' => $lap->driver_id,
                'driver_name' => $lap->driver->first_name . ' ' . $lap->driver->last_name ?? null,
                'lap_number' => $lap->lap_number,
                'team_id' => $lap->team_id,
                'team_name' => $lap->team->name ?? null,
                'car_id' => $lap->car_id,
                'car_number' => $lap->car->car_number ?? null,
                'lap_time' => $lap->lap_time,
                'created_at' => $lap->created_at,
            ]),
            'pagination' => [
                'current_page' => $laps->currentPage(),
                'total' => $laps->total(),
                'last_page' => $laps->lastPage(),
                'from' => $laps->firstItem(),
                'to' => $laps->lastItem(),
            ]
        ]);
    }

    /**
     * Store a newly created lap
     */
    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'race_id' => 'required|exists:races,id',
            'driver_id' => 'required|exists:drivers,id',
            'lap_number' => 'required|integer|min:1',
            'team_id' => 'required|exists:teams,id',
            'car_id' => 'required|exists:cars,id',
            'lap_time' => 'required|date_format:H:i:s.v',
        ]);

        try {
            $lap = Lap::create($validated);
            $lap->load(['race', 'driver', 'team', 'car']);

            return response()->json([
                'status' => 'success',
                'message' => 'Lap created successfully',
                'data' => [
                    'id' => $lap->id,
                    'race_id' => $lap->race_id,
                    'race_name' => $lap->race->name,
                    'driver_id' => $lap->driver_id,
                    'driver_name' => $lap->driver->first_name . ' ' . $lap->driver->last_name,
                    'lap_number' => $lap->lap_number,
                    'team_id' => $lap->team_id,
                    'team_name' => $lap->team->name,
                    'car_id' => $lap->car_id,
                    'car_number' => $lap->car->car_number,
                    'lap_time' => $lap->lap_time,
                    'created_at' => $lap->created_at,
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create lap',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Retrieve lap data for editing
     */
    public function edit($id)
    {
        $lap = Lap::with(['race', 'driver', 'team', 'car'])->find($id);

        if (!$lap) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lap not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $lap->id,
                'race_id' => $lap->race_id,
                'race_name' => $lap->race->name,
                'driver_id' => $lap->driver_id,
                'driver_name' => $lap->driver->first_name . ' ' . $lap->driver->last_name,
                'lap_number' => $lap->lap_number,
                'team_id' => $lap->team_id,
                'team_name' => $lap->team->name,
                'car_id' => $lap->car_id,
                'car_number' => $lap->car->car_number,
                'lap_time' => $lap->lap_time,
                'created_at' => $lap->created_at,
                'updated_at' => $lap->updated_at,
            ]
        ]);
    }

    /**
     * Update the lap in storage
     */
    public function update(Request $request, $id)
    {
        $lap = Lap::find($id);

        if (!$lap) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lap not found'
            ], 404);
        }

        // Validate request
        $validated = $request->validate([
            'race_id' => 'nullable|exists:races,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'lap_number' => 'nullable|integer|min:1',
            'team_id' => 'nullable|exists:teams,id',
            'car_id' => 'nullable|exists:cars,id',
            'lap_time' => 'nullable|date_format:H:i:s.v',
        ]);

        try {
            // Update only provided fields
            $lap->update(array_filter($validated, fn($value) => !is_null($value)));
            $lap->load(['race', 'driver', 'team', 'car']);

            return response()->json([
                'status' => 'success',
                'message' => 'Lap updated successfully',
                'data' => [
                    'id' => $lap->id,
                    'race_id' => $lap->race_id,
                    'race_name' => $lap->race->name,
                    'driver_id' => $lap->driver_id,
                    'driver_name' => $lap->driver->first_name . ' ' . $lap->driver->last_name,
                    'lap_number' => $lap->lap_number,
                    'team_id' => $lap->team_id,
                    'team_name' => $lap->team->name,
                    'car_id' => $lap->car_id,
                    'car_number' => $lap->car->car_number,
                    'lap_time' => $lap->lap_time,
                    'updated_at' => $lap->updated_at,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update lap',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the lap from storage
     */
    public function destroy($id)
    {
        $lap = Lap::find($id);

        if (!$lap) {
            return response()->json([
                'status' => 'error',
                'message' => 'Lap not found'
            ], 404);
        }

        try {
            $lap->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Lap deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete lap',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
