<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Sistem Penilaian Berkomputer">
    <meta name="author" content="Qbitgroup Software">
    <meta name="keyword" content="Penilaian,Berkomputer,Pentaksiran,PBT,Majlis Daerah">
    <style>
        body {
            font-size: 0.6rem;
            font-family: Arial, Helvetica, sans-serif;
        }

        table td {
            padding: 2px;
        }

        .table-bordered {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 2px;
        }

        @page {
            margin: 5px 25px 20px 70px;
        }

        header {
            text-align: center;
            text-decoration: underline;
            height: 30px;
        }

        section {
            page-break-after: always;
        }

        section:last-child {
            page-break-after: never;
        }

    </style>
</head>

<body>
@yield("content")
</body>

</html>
