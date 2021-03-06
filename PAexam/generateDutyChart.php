<?php

session_start();

if (!isset($_SESSION['adminId'])) {
    header('location:logout.php');
}

?>

<!doctype html>
<html>

<head>
    <title>Exam Seat Allotment | Admin</title>
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/css/mdb.min.css" rel="stylesheet">
    <!-- sweetalert css cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
    <style>
        h2 {
            font-size: 22px;
            margin-top: -15%;
        }

        .jumbotron {
            border-radius: 2.125rem;
        }

        .jumbotron:hover {
            -webkit-transform: translate(5px, 15px);
            -webkit-box-shadow: inset 0 0 10px #000000;
            cursor: pointer;
        }


        .btn1 {
            margin-top: 25%;
            margin-left: 5%;
        }
    </style>
</head>

<body>
    <!-- Image and text -->
    <nav class="navbar navbar-dark primary-color">
        <a class="navbar-brand" href="#">
            <img src="assets/images/logo.jpg" height="60" width="60" style="border-radius:50%;" class="d-inline-block align-top" alt="mdb logo"> P.A. College of Engineering Mangaluru | Admin
        </a>
        <a class="btn btn-light" href="admin.php"> back <i class="fas fa-arrow-circle-left"></i></a>
    </nav><br>


    <?php

    include('connection.php');

    $date = $_GET['date'];


    //for external squad fellas i mean squad people from other colleges
    echo '
     </tbody><div style="text-align: center;">
        <button style="background-color: skyblue" id="printPageButton"   onclick="window.print();">Print</button></div>
    </table>
    <style>@media print{
        #printPageButton{display: none;}
    }</style>
        </script>

    <h6 style="text-align:center; font-weight:bold" > P.A. COLLEGE OF ENGINEERING, MANGALURU </h6>
    <h6 style="text-align:center; font-weight:bold">VTU EXAMINATIONS, DUTY CHART</h6>
    <h6 style="text-align:left">DATE: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbspTIME :</h6>
    
    <table class="table table-bordered" style="text-align:center;">
        <thead class=" black-text">
            <tr>
                <th scope="col" style="font-weight:bold">SL No.</th>
                <th scope="col" style="font-weight:bold">NAME OF THE STAFF (CHIEF SUPDT.) [EXTERNAL]</th>
                <th scope="col" style="font-weight:bold">ALTERNATIVE</th>
                <th scope="col" style="font-weight:bold">SIGNATURE</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="col">  </th>
                <th scope="col">  </th>
                <th scope="col">  </th>
                <th scope="col">  </th>
            </tr>
       
        </tbody>
        </table>
    ';

    // for dcs fellas
    echo '
    <table class="table table-bordered" style="text-align:center;">
        <thead class=" black-text">
            <tr>
                <th scope="col" style="font-weight:bold">SL No.</th>
                <th scope="col" style="font-weight:bold">NAME OF THE STAFF (DEPUTY CHIEF SUPDT.) [INTERNAL]</th>
                <th scope="col" style="font-weight:bold">ALTERNATIVE</th>
                <th scope="col" style="font-weight:bold">SIGNATURE</th>
            </tr>
            </thead>
        <tbody>';
            
            $dateDCS = substr($date,1,7);
            
            $sql1 = "SELECT * FROM facultyallotment AS FA, facultylist AS FL WHERE FA.date = '$dateDCS' AND FA.facultyId = FL.id";
            $sql1Result = mysqli_query($conn, $sql1);
            // print_r($sql1Result);
            $DcsSrNo=1;
            while ($sql1ResultRow = mysqli_fetch_array($sql1Result)) {
                $DcsName = $sql1ResultRow['name'];

                echo '
                <tr>
                    <td scope="col"> '.$DcsSrNo.' </td>
                    <td scope="col"> '.$DcsName.' </td>                
                    <td scope="col">  </td>
                    <td scope="col">  </td>
                </tr>
                ';
                $DcsSrNo++;
            }
            echo '
        </tbody>
        </table>
        ';

         //for non dcs fellas
        echo '
    <table class="table table-bordered" style="text-align:center;">
        <thead class=" black-text">
            <tr>
                <th scope="col" style="font-weight:bold">SL No.</th>
                <th scope="col" style="font-weight:bold">NAME OF THE STAFF(RELIEVING/ROOM SUPDT.)</th>
                <th scope="col" style="font-weight:bold">MODE OF DUTY</th>
                <th scope="col" style="font-weight:bold">ALTERNATIVE</th>
                <th scope="col" style="font-weight:bold">EXAM HALL No.</th>
                <th scope="col" style="font-weight:bold">SIGNATURE</th>
            </tr>
            </thead>
        <tbody>';
            
            $sql2 = "SELECT * FROM facultyduty AS FD, facultylist AS FL WHERE FD.date = $date AND FD.facultyId = FL.facultyId";
            $sql2Result = mysqli_query($conn, $sql2);
            // print_r($sql2Result);
            $SrNo=1;
             while ($sql2ResultRow = mysqli_fetch_array($sql2Result)) {
                $NonDcsName = $sql2ResultRow['name'];

            echo '
            <tr>
                <td scope="col"> '.$SrNo.' </td>
                <td scope="col"> '.$NonDcsName.' </td>                
                <td scope="col">  </td>
                <td scope="col">  </td>
                <td scope="col">  </td>
                <td scope="col">  </td>
            </tr>
            ';
            $SrNo++;
            }
            echo '
        
        </tbody>
        </table>
        ';

         //for principal or vice principal fellas
        echo '
    <table class="table table-bordered" style="text-align:center;">
        <thead class=" black-text">
            <tr>
                
                <th scope="col" style="font-weight:bold">CHIEF SUPDT.</th>
                
                <th scope="col" style="font-weight:bold">SIGNATURE</th>
            </tr>
            </thead>
        <tbody>
            <tr>
                <th scope="col">  </th>
                <th scope="col">  </th>
                
            </tr>
            <tbody>
            </table>
        ';


    

    
        
        ?>


        
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.7/js/mdb.min.js"></script>
    <!-- sweetalert js cdn -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.js"></script>
</body>

</html>