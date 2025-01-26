<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

class GridController
{
    private $size = 3; // Grid size (3x3)

    public function getInitialState()
    {
        // Generate a randomized 3x3 grid with 'red' or 'blue'
        $grid = [];
        for ($i = 0; $i < $this->size; $i++) {
            $row = [];
            for ($j = 0; $j < $this->size; $j++) {
                $row[] = rand(0, 1) ? 'red' : 'blue';
            }
            $grid[] = $row;
        }

        return response()->json(['grid' => $grid]);
    }

    public function updateState(Request $request)
    {
        $grid = $request->input('grid'); // Current grid state
        $x = $request->input('x');       // Clicked row
        $y = $request->input('y');       // Clicked column

        $currentColor = $grid[$x][$y];
        $newColor = $currentColor === 'red' ? 'blue' : 'red';

        // Toggle the clicked square's color
        $grid[$x][$y] = $newColor;

        // Change adjacent squares
        $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]]; // Up, Down, Left, Right
        foreach ($directions as [$dx, $dy]) {
            $nx = $x + $dx;
            $ny = $y + $dy;

            if (isset($grid[$nx][$ny])) {
                $grid[$nx][$ny] = $grid[$nx][$ny] === 'red' ? 'blue' : 'red';
            }
        }

        return response()->json(['grid' => $grid]);
    }
}
