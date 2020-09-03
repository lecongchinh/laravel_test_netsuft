<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staffs</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   
</head>

<body>
    <div class="container">
        @if(!empty($successMessage))
            <div class="alert alert-success mt-5"> {{ $successMessage }}</div>
        @endif
        @if(!empty($errorMessage))
            <div class="alert alert-danger mt-5"> {{ $errorMessage }}</div>
        @endif
        <div class="row mt-5">
            <div class="search col-5 p-0 m-auto border">
                <div class="title border-bottom">
                    <h3 class="pl-3 pr-3 font-weight-bold">Title</h3>
                </div>
                <form action="{{ route('get.staffs') }}" id="form-search" method="get">
                    @csrf
                    <div class="content p-3">
                        <p class="font-weight-bold">From entry date</p>
                        <div class="form-group row">
                            <div class="col-5">
                                <input type="text" value="{{ old('from_day') ?? $dataRequest['from_day'] }}" name="from_day" class="form-control">
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-4">
                                        <span>days</span>
                                    </div>
                                    <div class="col-8">
                                        <span>Over or equal >=</span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->first('from_day'))
                                <p class="text-danger ml-3 error_from_day">{{ $errors->first('from_day') }}</p>
                            @endif
                        </div>
                        <div class="form-group row">
                            <div class="col-5">
                                <input type="text" value="{{ old('to_day') ?? $dataRequest['to_day'] }}" name="to_day" class="form-control">
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-4">
                                        <span>days</span>
                                    </div>
                                    <div class="col-8">
                                        <span>Under</span>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->first('to_day'))
                                <p class="text-danger error_email ml-3">{{ $errors->first('to_day') }}</p>
                            @endif
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label font-weight-bold">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" value="{{ old('email') ?? $dataRequest['email']  }}" name="email" class="form-control">
                                @if ($errors->first('email'))
                                    <p class="text-danger error_email">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10 m-auto">
                                <div class="row">
                                    <div class="col">
                                        <button style="cursor: pointer" type="submit" class="form-control btn-btn-light font-weight-bold">SUBMIT</button>
                                    </div>
                                    <div class="col">
                                        <button style="cursor: pointer" type="button" class="form-control btn-btn-light font-weight-bold clear">CLEAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="data-search mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Email</th>
                        <th scope="col" class="text-center">Entry Date</th>
                        <th scope="col" class="text-center">Day of Week</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($staffs))
                        @foreach ($staffs as $staff)
                            <tr>
                                <th  class="text-center">{{ $staff->StaffID }}</th>
                                <td>{{ $staff->StaffName }}</td>
                                <td>{{ $staff->Email }}</td>
                                <td class="text-center">{{ $staff->TrialEntryDate }}</td>
                                <td class="text-center">{{ config('constants.dayOfWeek.' . Carbon\Carbon::parse($staff->TrialEntryDate)->dayOfWeek) }}</td>
                            </tr>    
                        @endforeach
                    @endif
                </tbody>
            </table>
            @if (isset($staffs))
                <div class="text-center m-auto ml-5">
                    {{ $staffs->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script src="{{ asset('js/staffs.js') }}"></script>

</html>
