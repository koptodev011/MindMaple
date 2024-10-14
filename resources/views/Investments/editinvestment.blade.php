@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Edit Investment</h1>
    <form action="{{ route('Updateinvestment', $editInvestment->id) }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="area_of_earning">Investment Area</label>
            <input type="text" name="investmentarea" class="form-control @error('investmentarea') is-invalid @enderror"
                value="{{ old('investment_area', $editInvestment->investment_area) }}" required>
            @error('investmentarea')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror"
                value="{{ old('amount', $editInvestment->amount) }}" required>
            @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="rate_of_interest">Rate of Interest</label>
            <input type="number" name="rate_of_interest"
                class="form-control @error('rate_of_interest') is-invalid @enderror"
                value="{{ old('rate_of_interest', $editInvestment->rate_of_interest) }}" required>
            @error('rate_of_interest')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <div class="form-group">
            <label for="expenceMonth">Period</label>
            <select name="period" class="form-control" class="form-control @error('period') is-invalid @enderror"
                value="{{ old('period', $editInvestment->period) }}" required>
                <option value="">Select a period</option>
                <option value="1">Month</option>
                <option value="2">year</option>

            </select>
            @error('period')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="form-group">
            <label for="month_number">Month</label>
            <select name="month_number" class="form-control @error('month_number') is-invalid @enderror" required>
                @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}"
                    {{ old('month_number', $editInvestment->month_number) == $i ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
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
