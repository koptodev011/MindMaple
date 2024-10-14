@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Edit Subject</h1>
    <form action="{{ route('Updatesubject', $subject->id) }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="sectionName">Subject Name</label>
            <input type="text" name="subjectName" class="form-control @error('subject_name') is-invalid @enderror" value="{{ old('subject-name', $subject->subject_name) }}" required>
            @error('subjectName')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
