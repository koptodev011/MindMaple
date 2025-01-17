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
                            <h3 class="m-0 font-weight-bold text-primary">Investments</h3>

                            <div class="navbar-nav m">
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addEarningModal">
                                        Add investments
                                    </button>
                                </li>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Investment Area</th>
                                            <th>Amount</th>
                                            <th>Rate of interest</th>
                                            <th>Period</th> <!-- New column for actions -->
                                            <th>Month</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>Investment Area</th>
                                            <th>Amount</th>
                                            <th>Rate of interest</th>
                                            <th>Period</th> <!-- New column for actions -->
                                            <th>Month</th>

                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($investments as $exp)
                                        <tr>
                                            <td>{{ $exp->investment_area }}</td>
                                            <td>{{ $exp->amount }}</td>
                                            <td>{{ $exp->rate_of_interest }}</td>
                                            <td>{{ $exp->period }}</td>

                                            <td>{{ date('F', mktime(0, 0, 0, $exp->month, 1)) }}</td>


                                            <td>
                                                <div style="margin-left: 10px;">
                                                    <a href="{{ route('editInvestment', $exp->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>

                                                    <form action="{{ route('Deleteinvestment', $exp->id) }}" method="POST"
                                                        style="display:inline;">
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
                    <h5 class="modal-title" id="addEarningLabel">Add Expence</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="earningForm" action="{{ route('Addinvestment') }}" method="POST" novalidate>
                        @csrf
                        <div id="formFields">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="earningName">Investment Area</label>
                                    <input type="text" class="form-control" name="investmentarea"
                                        placeholder="Enter Investment Area" required>
                                    @error('investmentarea')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="earningAmount">Amount</label>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter Amount"
                                        required>
                                    @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="form-group col-md-4">
                                    <label for="earningAmount">Rate of interest</label>
                                    <input type="number" class="form-control" name="interest" placeholder="Enter Amount"
                                        required>
                                    @error('interest')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="expenceMonth">Period</label>
                                    <select name="period" class="form-control" required>
                                        <option value="">Select a period</option>
                                        <option value="1">Month</option>
                                        <option value="2">year</option>

                                    </select>
                                    @error('period')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="expenceMonth">Month</label>
                                    <select name="month" class="form-control" required>
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
                                    @error('month')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save investment</button>
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


</body>
@endsection

</html>
