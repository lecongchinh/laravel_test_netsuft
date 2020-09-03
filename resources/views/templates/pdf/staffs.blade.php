<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Staffs</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            body {
              font-family: "ipag";
            }
          </style>
</head>

<body>
    <div class="">
        <div class="data-search">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Entry Date</th>
                        <th scope="col">Day of Week</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($staffs))
                        @foreach ($staffs as $staff)
                            <tr>
                                <th class="text-center">{{ $staff->StaffID }}</th>
                                <td>{{ $staff->StaffName }}</td>
                                <td>{{ $staff->staff2->Email }} </td>
                                <td class="text-center">{{ $staff->TrialEntryDate }}</td>
                                <td class="text-center">{{ config('constants.dayOfWeek.' . Carbon\Carbon::parse($staff->TrialEntryDate)->dayOfWeek) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
