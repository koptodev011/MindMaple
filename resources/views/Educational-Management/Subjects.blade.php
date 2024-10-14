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
        transition: opacity 0.3s ease;
    }

    #sections:hover {
        opacity: 0.7;
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModal">
                        Add Subject
                    </button>
                    <button style="margin-left:30px" type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#createRoadmapModal">
                        Create Roadmap
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <div class="row">
        @foreach($subjects as $subject)
        <div class="col-lg-4">
            <div id="sections" class="card">
                <div class="card-body">
                    <a>
                        <h1
                            style="text-align:center; margin-top:18px; font-weight:600; font-size:30px; font-family:inherit; cursor:pointer;">
                            {{ $subject->subject_name }}
                        </h1>
                    </a>
                    <div class="button-container">
                    <a href="{{ route('editsubject', ['id' => $subject->id]) }}" class="btn btn-primary">Edit</a>


                    <form action="{{ route('Deletesubject', $subject->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="margin-left: 20px;" type="submit"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </form>

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addSubjectModalLabel">Add Subject</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Addedusubject', ['id' => $id]) }}" id="educationForm" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="educationSubjectName" class="font-weight-bold">Education Subject Name</label>
                            <input type="text" class="form-control" id="educationSubjectName" name="edusubjectname"
                                placeholder="Enter Education Subject Name" required>
                        </div>
                        @error('edusubjectname')
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

    <!-- Create Roadmap Modal -->
    <div class="modal fade" id="createRoadmapModal" tabindex="-1" role="dialog"
        aria-labelledby="createRoadmapModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="createRoadmapModalLabel">Create Roadmap</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('Createroadmap') }}" id="roadmapForm" method="POST" novalidate>
    @csrf
    <div id="formFields">
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="subject_id" class="font-weight-bold">Subject</label>
                    <select class="form-control" name="subject_id[]" required>
                        <option value="" disabled selected>Select a Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="startDate" class="font-weight-bold">Start Date</label>
                    <input type="date" class="form-control" name="start_date[]" required>
                    @error('start_date.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="endDate" class="font-weight-bold">End Date</label>
                    <input type="date" class="form-control" name="end_date[]" required>
                    @error('end_date.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" id="addMore">Add more</button>
    <button type="submit" class="btn btn-danger">Create Roadmap</button>
</form>

<script>
document.getElementById('addMore').addEventListener('click', function() {
    const formFields = document.getElementById('formFields');

    const newFields = `
        <div class="row mb-3">
            <div class="col">
                <div class="form-group">
                    <label for="subject_id" class="font-weight-bold">Subject</label>
                    <select class="form-control" name="subject_id[]" required>
                        <option value="" disabled selected>Select a Subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="startDate" class="font-weight-bold">Start Date</label>
                    <input type="date" class="form-control" name="start_date[]" required>
                    @error('start_date.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="endDate" class="font-weight-bold">End Date</label>
                    <input type="date" class="form-control" name="end_date[]" required>
                    @error('end_date.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    `;

    formFields.insertAdjacentHTML('beforeend', newFields);
});
</script>




                    <script>
                    function submitForm() {
                        document.getElementById('educationForm').submit();
                    }

                    function submitRoadmapForm() {
                        document.getElementById('roadmapForm').submit();
                    }
                    </script>

                    <!-- Include jQuery and Bootstrap JS -->
                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
@endsection

</html>
