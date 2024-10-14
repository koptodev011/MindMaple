@extends('layouts.layout')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mindmaple</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 2px solid #007bff;
    }

    .modal-footer {
        border-top: 2px solid #007bff;
    }
    </style>
</head>

@section('content')

<body id="page-top">
    <div id="wrapper">
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        <div id="content-wrapper" class="d-flex flex-column">
            @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
            @endif
            <div id="content">

                <div class="container-fluid">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h3 class="m-0 font-weight-bold text-primary">Earnings</h3>
                            <div style="margin-left: 150px; margin-top:10px" class="totalpayment">
    <h2>Total Earning = {{ $totalearning }}</h2>
</div>
                            <ul class="navbar-nav ml-auto">
                                <li>
                                    <form action="{{ route('Expence') }}" method="GET">
                                        <button type="submit" class="btn btn-danger">
                                            View Expense
                                        </button>
                                    </form>

                                </li>
                            </ul>
                           
                            <div class="navbar-nav m">
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addEarningModal">
                                        Add Earning
                                    </button>
                                </li>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Area of earning</th>
                                            <th>Amount</th>
                                            <th>Month</th>
                                            <th>Actions</th> <!-- New column for actions -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Area of earning</th>
                                            <th>Amount</th>
                                            <th>Month</th>
                                            <th>Actions</th> <!-- New column for actions -->
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($earnings as $earning)
                                        <tr>
                                            <td>{{ $earning->area_of_earning }}</td>
                                            <td>{{ $earning->amount }}</td>
                                            <td>{{ date('F', mktime(0, 0, 0, $earning->month_number, 1)) }}</td>
                                            <td>
                                                <div style="margin-left: 10px;">
                                                    <a href="{{ route('Editearning', $earning->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>

                                                    <form action="{{ route('Deleteearning', $earning->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="margin-left: 20px;" type="submit"
                                                            class="btn btn-danger btn-sm">Delete</button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal for Adding Earning -->
    <div class="modal fade" id="addEarningModal" tabindex="-1" role="dialog" aria-labelledby="addEarningLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="addEarningLabel">Add Earning</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="earningForm" action="{{ route('Addearning') }}" method="POST" novalidate>
                        @csrf
                        <div id="formFields">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="earningName">Area of Earnings</label>
                                    <input type="text" class="form-control" name="earningName[]"
                                        placeholder="Enter Earning Name" required>
                                    @error('earningName.*')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="earningAmount">Amount</label>
                                    <input type="number" class="form-control" name="earningAmount[]"
                                        placeholder="Enter Amount" required>
                                    @error('earningAmount.*')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="earningMonth">Month</label>
                                    <select name="earningMonth[]" class="form-control" required>
                                        <option value="">Select a month</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    @error('earningMonth.*')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-secondary mb-3" id="addMoreBtn">Add More</button>



                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Earnings</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.getElementById('addMoreBtn').addEventListener('click', function() {
            const formFields = document.getElementById('formFields');
            const newFields = document.createElement('div');
            newFields.className = 'form-row';
            newFields.innerHTML = `
        <div class="form-group col-md-4">
            <label for="earningName">Area of Earnings</label>
            <input type="text" class="form-control" name="earningName[]" placeholder="Enter Earning Name" required>
        </div>
        <div class="form-group col-md-4">
            <label for="earningAmount">Amount</label>
            <input type="number" class="form-control" name="earningAmount[]" placeholder="Enter Amount" required>
        </div>
        <div class="form-group col-md-4">
            <label for="earningMonth">Month</label>
            <select name="earningMonth[]" class="form-control" required>
                <option value="">Select a month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div>
    `;
            formFields.appendChild(newFields);
        });
        </script>
</body>
@endsection

</html>
