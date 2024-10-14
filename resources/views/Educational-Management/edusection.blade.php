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
}

.subsection {
display: flex;
}


#sections {
    background-color: #dee4f4;
    margin-top: 30px;
    width: 320px;
    height: 130px;
    margin-left: 50px;
    border-radius: 10px;
    position: relative; /* Ensure positioning for the button container */
    overflow: hidden;   /* Hide buttons initially */
    transition: opacity 0.3s ease; /* Smooth transition for opacity */
}

#sections:hover {
    opacity: 0.7; /* Reduce opacity on hover */
}

.button-container {
    display: flex;
    justify-content: space-around; /* Space buttons evenly */
    position: absolute; /* Position buttons within the card */
    bottom: 10px; /* Position at the bottom */
    left: 0;
    right: 0;
    opacity: 0; /* Hide buttons initially */
    transition: opacity 0.3s ease; /* Smooth transition */
}

#sections:hover .button-container {
    opacity: 1; /* Show buttons on hover */
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
                    <h1 style="text-align:center; margin-top:18px; font-weight:600; font-size:30px; font-family:inherit; cursor:pointer;">
                        {{ $section->edusection }}
                    </h1>
                </a>
                <div class="button-container">
                    <a href="{{ route('editsection', ['id' => $section->id]) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('Deletesection', $section->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="margin-left: 20px;" type="submit"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                    <a href="{{ route('subjects', ['id' => $section->id]) }}" class="btn btn-info">View</a>

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
                    <h5 class="modal-title" id="addEarningLabel">Add Earning</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Addedusection') }}" id="educationForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="educationSectionName" class="font-weight-bold">Education Section Name</label>
                            <input type="text" class="form-control" id="educationSectionName"
                                name="edusectionname" placeholder="Enter Education Section Name" required>
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
