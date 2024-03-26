<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Report Task</title>
    <style media="all" type="text/css">
        h1 {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
            color: #3A3A3A;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        .tbl-header {
            background-color: #008A90;
        }

        .tbl-content {
            height: 100%;
            overflow-x: auto;
            margin-top: 0px;
            border: 1px solid #dddddd;
            background-color: #ACA9BB;
        }

        th {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            padding: 20px 15px;
            text-align: left;
            font-weight: 500;
            font-size: 12px;
            color: #fff;
            text-transform: uppercase;
        }

        td {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            padding: 15px;
            text-align: left;
            vertical-align: middle;
            font-weight: 400;
            font-size: 12px;
            color: #3A3A3A;
            border-bottom: solid 1px rgba(255, 255, 255, 0.1);
        }

        table tbody tr:nth-child(odd) {
            background: #F9F9F9;
        }

        table tbody tr:nth-child(even) {
            background: #DDDAED;
        }


        /* demo styles */

        @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);

        body {

            font-family: 'Roboto', sans-serif;
        }

        section {
            margin: 25px;
        }

        .made-by {
            margin-top: 40px;
            padding: 10px;
            clear: left;
            text-align: center;
            font-size: 10px;
            font-family: arial;
            color: #3A3A3A;
        }
    </style>
</head>

<body>
    <section>
        @if (!$data->start_date && !$data->end_date)
            <h1>All Tasks</h1>
        @elseif (!$data->start_date)
            <h1>All Tasks from {{ $data->start_date }} to today</h1>
        @elseif (!$data->end_date)
            <h1>All Tasks until {{ $data->start_date }}</h1>
        @else
            <h1>All Tasks from {{ $data->start_date }} to {{ $data->end_date }}</h1>
        @endif
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Time to complete</th>
                        <th>Employee</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    @foreach ($data->tasks as $task)
                        <tr>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->time_to_complete }}</td>
                            <td>{{ $task->user->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <div class="made-by">
        Task Manager, Posadas, Misiones, Argentina
    </div>
</body>

</html>
