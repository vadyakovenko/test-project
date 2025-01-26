@extends('layouts.app')

@section('title', 'Screen one')

@section('content')
    <div>
        <input type="text" id="search" placeholder="Search..." class="form-control mb-3">
        <hr>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Notes</th>
            </tr>
            </thead>
            <tbody id="records">
            <!-- Records will be populated here -->
            </tbody>
        </table>
    </div>

    <script>
        let timer;

        document.getElementById('search').addEventListener('keyup', function () {
            clearTimeout(timer);
            const search = this.value;

            timer = setTimeout(() => {
                fetchRecords(search);
            }, 300); // 300ms debounce
        });

        document.addEventListener('DOMContentLoaded', () => {
            fetchRecords(); // Fetch default records on load
        });

        function fetchRecords(search = '') {
            fetch(`/api/records/search?search=${search}`)
                .then(response => response.json())
                .then(data => {
                    const records = data.data;
                    const tbody = document.getElementById('records');
                    tbody.innerHTML = '';

                    records.forEach(record => {
                        const row = `
                        <tr>
                            <td>${record.id}</td>
                            <td>${record.title}</td>
                            <td>${record.status}</td>
                            <td>${record.notes}</td>
                        </tr>
                    `;
                        tbody.innerHTML += row;
                    });
                });
        }
    </script>
@endsection
