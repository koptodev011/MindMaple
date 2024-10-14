@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Edit Section</h1>
    <form action="{{ route('Updatesection', $editsection->id) }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="sectionName">Section Name</label>
            <input type="text" name="sectionName" class="form-control @error('sectionName') is-invalid @enderror" value="{{ old('sectionName', $editsection->edusection) }}" required>
            @error('sectionName')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
