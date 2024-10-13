@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Edit Earning</h1>
    <form action="{{ route('updateearning', $editearning->id) }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="area_of_earning">Area of Earning</label>
            <input type="text" name="area_of_earning" class="form-control @error('area_of_earning') is-invalid @enderror" value="{{ old('area_of_earning', $editearning->area_of_earning) }}" required>
            @error('area_of_earning')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $editearning->amount) }}" required>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="month_number">Month</label>
            <select name="month_number" class="form-control @error('month_number') is-invalid @enderror" required>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ old('month_number', $editearning->month_number) == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                @endfor
            </select>
            @error('month_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
