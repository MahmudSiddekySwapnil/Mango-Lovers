<head>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>

        /*this style is to make the datatables search bar in middle. will take effect after the display:none is removed*/
        .dataTables_wrapper .dataTables_filter {
            display: none;
            width: 100%;
            text-align: center;
        }

        .dataTables_wrapper .filters {
            /*transform: scale(2);*/
        }

        /*making the column filter box aligned with row data*/
        .filters input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
            margin-left: -10px;
        }

        /*message box styling*/
        .alert {
            /*padding: 1px;*/
            border-radius: 8px;
            font-size: large;
            color: #000000;
            background-color: #add2b2;
            width: fit-content;
            border: solid 3px #4db26a;
            margin: 8px;
            padding: 10px;
        }

        /*buttons (icons) alignment to right*/
        div.dt-buttons {
            width: 50%;
            float: right;
            text-align: right;
        }

        table.dataTable th, table.dataTable td {
            box-sizing: initial;
            border-block-width: inherit;
            overflow: hidden;
            height: 30px;
            text-overflow: ellipsis;
        }
    </style>
</head>
