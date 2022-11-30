<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Customer Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script> 
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
            </div>
        </div>
        <form action="{{ URL::current() }}" method="post">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if (isset($customer))
                                <h5>Update Customer</h5>
                            @else
                                <h5>Add New Customer</h5>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" id="firstname"
                                        value="{{ isset($customer) ? $customer->firstname : '' }}" class="form-control">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" name="middlename" id="middlename"
                                        value="{{ isset($customer) ? $customer->middlename : '' }}"
                                        class="form-control">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" id="lastname"
                                        value="{{ isset($customer) ? $customer->lastname : '' }}" class="form-control">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" name="mobile" id="mobile"
                                        value="{{ isset($customer) ? $customer->mobile : '' }}" class="form-control">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="email">Email Address</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ isset($customer) ? $customer->email : '' }}" class="form-control">
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city"
                                        value="{{ isset($customer) ? $customer->city : '' }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            @if (isset($customer))
                                <input type="submit" value="Update" name="update" class="btn btn-primary">
                            @else
                            <input type="submit" value="Add" name="add" class="btn btn-primary">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if (isset($customers))
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            All Customers
                        </div>
                        <div class="card-body">
                            <table class="table" id="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Firstname</th>
                                        <th>Middlename</th>
                                        <th>Lastname</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                   
                  var table = $('#data-table').DataTable({
                      processing: true,
                      serverSide: true,
                      ajax: "table",
                      columns: [
                          {data: 'id', name: 'id'},
                          {data: 'firstname', name: 'firstname'},         
                          {data: 'middlename', name: 'middlename'},
                          {data: 'lastname', name: 'lastname'},         
                          {data: 'mobile', name: 'mobile'},         
                          {data: 'email', name: 'email'},         
                          {data: 'city', name: 'city'},         
                          {data: 'action', name: 'action'},         
                      ]
                  });
                   
                });
              </script>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
