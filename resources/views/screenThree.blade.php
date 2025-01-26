@extends('layouts.app')

@section('title', 'Screen three')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Interactive Grid</h1>
        <div id="grid" class="d-flex flex-column"></div>
    </div>

    <style>
        .row {
            display: flex;
        }
        .square {
            width: 100px;
            height: 100px;
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        .red {
            background-color: red;
        }
        .blue {
            background-color: blue;
        }
    </style>

    <script>
        let gridState = [];

        document.addEventListener('DOMContentLoaded', () => {
            fetchInitialState();
        });

        function fetchInitialState() {
            fetch('/api/grid')
                .then(response => response.json())
                .then(data => {
                    gridState = data.grid;
                    renderGrid();
                })
                .catch(error => console.error('Error fetching initial state:', error));
        }

        function updateGrid(x, y) {
            fetch('/api/grid', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ grid: gridState, x, y }),
            })
                .then(response => response.json())
                .then(data => {
                    gridState = data.grid;
                    renderGrid();
                })
                .catch(error => console.error('Error updating grid state:', error));
        }

        function renderGrid() {
            const gridElement = document.getElementById('grid');
            gridElement.innerHTML = '';

            gridState.forEach((row, x) => {
                const rowElement = document.createElement('div');
                rowElement.classList.add('row');

                row.forEach((color, y) => {
                    const square = document.createElement('div');
                    square.classList.add('square', color);
                    square.addEventListener('click', () => updateGrid(x, y));
                    rowElement.appendChild(square);
                });

                gridElement.appendChild(rowElement);
            });
        }
    </script>
@endsection
