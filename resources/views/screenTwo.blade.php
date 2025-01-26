@extends('layouts.app')

@section('title', ' Screen two')

@section('content')
    <div class="container my-4">
        <h1 class="mb-4">Image Search</h1>
        <form id="searchForm" class="mb-3">
            <input type="text" id="searchQuery" class="form-control mb-3" placeholder="Search..." required>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <div id="imageDisplay" class="text-center d-none">
            <button id="prevButton" class="btn btn-secondary me-3" disabled>&larr; Previous</button>
            <img id="searchImage" src="" alt="Search Result" class="img-fluid" style="max-height: 400px;">
            <button id="nextButton" class="btn btn-secondary ms-3" disabled>Next &rarr;</button>
        </div>
    </div>

    <script>
        let currentPage = 1;
        let currentQuery = '';

        document.getElementById('searchForm').addEventListener('submit', function (e) {
            e.preventDefault();
            currentPage = 1;
            currentQuery = document.getElementById('searchQuery').value;
            fetchImage(currentQuery, currentPage);
        });

        document.getElementById('prevButton').addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                fetchImage(currentQuery, currentPage);
            }
        });

        document.getElementById('nextButton').addEventListener('click', function () {
            currentPage++;
            fetchImage(currentQuery, currentPage);
        });

        function fetchImage(query, page) {
            fetch(`/api/unsplash?query=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const image = data.results[0];
                    if (image) {
                        document.getElementById('searchImage').src = image.urls.regular;
                        document.getElementById('prevButton').disabled = page <= 1;
                        document.getElementById('nextButton').disabled = false;
                        document.getElementById('imageDisplay').classList.remove('d-none');
                    } else {
                        document.getElementById('searchImage').src = '';
                        document.getElementById('prevButton').disabled = true;
                        document.getElementById('nextButton').disabled = true;
                        document.getElementById('imageDisplay').classList.add('d-none');
                        alert('No results found.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching image:', error);
                    alert('Failed to fetch images. Please try again.');
                });
        }
    </script>
@endsection
