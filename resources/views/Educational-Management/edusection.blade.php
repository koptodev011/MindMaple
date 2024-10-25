@extends('layouts.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles to ensure the modal is centered */
        .modal-dialog {
            display: flex;
            align-items: center;
            min-height: calc(100vh - 1rem);
        }

        #sections {
            background-color: #dee4f4;
            margin-top: 30px;
            width: 320px;
            height: 130px;
            margin-left: 50px;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        #sections:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #sections:hover .button-container {
            opacity: 1;
        }

        .btn-custom {
            border-radius: 5px;
            width: 80px; /* Fixed width for buttons */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }

        .btn-danger, .btn-info {
            width: 80px; /* Same width for other buttons */
            transition: background-color 0.3s ease;
        }

        .btn-danger {
            border-radius: 5px; /* Ensure consistent rounding */
        }

        .btn-danger:hover {
            background-color: #c82333;
            color: white;
        }

        .btn-info:hover {
            background-color: #17a2b8;
            color: white;
        }
    </style>
</head>
@section('content')

<body>
@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body">
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid justify-content-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Add Section
                </button>
            </div>
        </nav>
    </div>
</div>

<div class="row">
    @foreach($edusections as $section)
    <div class="col-lg-4">
        <div id="sections" class="card">
            <div class="card-body">
                <a>
                    <h1 class="text-center my-3 font-weight-bold" style="font-size: 30px;">
                        {{ $section->edusection }}
                    </h1>
                </a>
                <div class="button-container">
                    <a href="{{ route('editsection', ['id' => $section->id]) }}" class="btn btn-custom btn-primary">Edit</a>
                    <form action="{{ route('Deletesection', $section->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-custom btn-danger">Delete</button>
                    </form>
                    <a href="{{ route('subjects', ['id' => $section->id]) }}" class="btn btn-custom btn-info">View</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addEarningLabel">Add Section</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('Addedusection') }}" id="educationForm" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="educationSectionName" class="font-weight-bold">Education Section Name</label>
                        <input type="text" class="form-control" id="educationSectionName" name="edusectionname" placeholder="Enter Education Section Name" required>
                    </div>
                    @error('edusectionname')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="submitForm()">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm() {
        document.getElementById('educationForm').submit();
    }
</script>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
@endsection

</html>
