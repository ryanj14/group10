<?php
    session_start();
    require_once('mysqli_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calculator</title>
    <meta charset="utf-8">

    <!-- Eleos Tab Icon -->
    <link rel="icon" href="Images/eleosIcon.png">

    <!-- CSS Files -->
    <link rel="stylesheet" href="CSS/Base.css" type="text/css">

    <!-- For IE browser compatibility-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- For Respoinsive setting -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap-->
    <link href="CSS/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>

<div id="container"> <!--Put every thing from nav to footer-->

    <nav>
        <li><a href="Index.html">Home</a></li>
        <li><a href="Waitinglist.php">Waiting List</a></li>
        <li><a href="TechnologyPage.html">Our Technology</a></li>
        <li><a href="NewsPage.html">News</a></li>
        <li><a href="Aboutus.html">About Us</a></li>
        <li><a href="ContactUs.html">Contact Us</a></li>
        <li><a href="Calculator.html">Calculator</a></li>
    </nav>

    <!-- The results of the form input -->
    <?php
        setlocale(LC_MONETARY,"en_CA");
        // I have to create php variables just to insert into our mysqli table and it won't let me use $_POST...
        $growType = $_POST['growingType'];

        $vegetables = setValue($_POST['cultivate']);
        $orchards = setValue($_POST['cultivate2']);
        $berries = setValue($_POST['cultivate3']);
        $vine = setValue($_POST['cultivate4']);
        $herb = setValue($_POST['cultivate5']);
        $other = setValue($_POST['cultivate6']);
        $hire = $_POST['weeding'];
        $workHire = $_POST['workers'];
        $workHours = $_POST['weeklyWorkers'];
        $budget = $_POST['annualBudget'];
        $workExpense = ($_POST['expense'] / 100) * $budget;
        $machineExp = ($_POST['expense2'] / 100) * $budget;
        $pytoExp = ($_POST['expense3'] / 100) * $budget;
        $otherExp = ($_POST['expense4'] / 100) * $budget;

        function getAcres() {
            global  $vegetables, $orchards, $berries, $vine, $herb, $other;
            $acres = $vegetables + $orchards + $berries + $vine + $herb + $other;
            return $acres;
        }

        function setValue($value) {
            if (!is_numeric($value))
                return 0;
            else
                return $value;
        }

        $acres = getAcres();

        echo "Growing Type: ". setValue($_POST['growingType'])."<br>";
        echo "Number of acres: ". $acres ."<br>";
        echo "Vegtables cultivated: " . $vegetables."<br>";
        echo "Orchards cultivated: ". $orchards ."<br>";
        echo "Berries cultivated: ". $berries ."<br>";
        echo "Vineyards cultivated: ". $vine."<br>";
        echo "Herbs cultivated: ". $herb."<br>";
        echo "Others cultivated: ". $other ."<br>";
        echo "Do you hire people for weeding? ". $_POST['weeding'] ."<br>";
        echo "Number of workers hired: ". $_POST['workers'] ."<br>";
        echo "Hours total for weeding for workers: ". $_POST['weeklyWorkers'] ."<br>";
        echo "Annual budget: $". $budget ."<br>";
        echo "Workers expenses: $". $workExpense ."<br>";
        echo "Machinery expenses: $". $machineExp ."<br>";
        echo "Phytosanitary expenses: $". $pytoExp ."<br>";
        echo "Other expenses: $". $otherExp ."<br>";
        echo "<br>";
        echo "Peak harvesting months:<br>";
        if(!empty($_POST['month_list2'])){
            foreach($_POST['month_list2'] as $selected){
                echo $selected."<br>";
            }
        }
        echo "<br>";
        echo "Months for weeding:<br>";
        if(!empty($_POST['month_list'])){
            foreach($_POST['month_list'] as $selected2){
                echo $selected2."<br>";
            }
            echo "<br>";
        }

        // Connecting to the database
        $list = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // If we don't connect to the database it will spit out an error for us to fix
        if(!$list){
            die("Connection failed: ".mysqli_connect_error()); // Remove the connect_error method after done testing because of hacking issues.
        }

        // Inserting in the Calculator table. It's long I know.
        $sql = "INSERT INTO Calculator (id, growType, numAcres, vegtables,orchards,berries,vineyards,herbs,otherCult,hire,workHire,workHours,annualBudget,workExpense,machineExpense,phytoExpense,otherExpense)
        VALUES (NULL,'$growType', $acres, $vegetables, $orchards, $berries, $vine, $herb, $other, '$hire', $workHire, $workHours, $budget, $workExpense, $machineExp, $pytoExp, $otherExp)";

        echo "<br>";

        // Checking to see if we actually placed the data into the database
        if (mysqli_query($list, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($list). "<br>";
        }

        // Closing the connection to the database
        mysqli_close($list);


        /*
            The calculator part
        */
        $botPrice = 10000; // variable A
        $budget = $_POST['annualBudget']; // variable U
        $cash = $budget - $botPrice;
        $acreSaving = $cash * $acres;

        if(($cash <= 0) && ($acreSaving <= 0)) {
            echo "It looks like you are doing a great job keeping you weeding budget to a minimum. Please consider Culture Bot to increase your crop yield<br>";
        } else {
            echo "Congratulations! With Culturebot, you can sav CAD $cash per year compated to your current weeding process!(Equivalent to CAD $acreSaving /year/acre)<br>";
        }

        $phytosanitary = $_POST['expense3']; // variable m
        $E = ((($budget - $phytosanitary) / ($budget * $botPrice)) * $acres);
        $F = (($budget - $phytosanitary) / ($budget * $botPrice));
        if(!(($E <= 0) && ($F <= 0))) {
            echo "You can also save CAD $E on phystosanitary products yearly!(Equivalent to CAD $F year/acre)<br>";
        }
        $workers = $_POST['expense']; // variable k
        $workerBudget = $_POST['workers']; // variable S
        $workerHours = $_POST['weeklyWorkers'];
        $H = (($budget - $workers) / ($budget * $botPrice) * $acres);
        $G = ($H / (($workers * $acres) / $workerBudget));
        $J = (((($workerHours * 52) / $workerBudget) * $G) / 52);

        if(!(($H <= 0) && ($G <= 0) && ($J <= 0))) {
            $HH = number_format($H,2);
            $GG = round($G,0,PHP_ROUND_HALF_UP);
            //$JJ = round($J);
            echo "Last but not least, you can re-allocate or dismiss $G workers, saving CAD $HH yearly and a total of $J hours weekly.<br>";
        }
    ?>

    <!---Footer Start--->
    <footer>
      <!--Supporters-->
      <div id="footerSupporter">
        <div class="supporterTop">
          <img src="images/flogo1.png" alt="growingFoward-logo">
          <img src="images/flogo2.jpg" alt="investmentAgriculture-logo">
          <img src="images/flogo3.png" alt="nrc-cnrc-logo">
          <img src="images/flogo4.png" alt="nserc-crsng-logo">
          <img src="images/flogo5.png" alt="britishColumbia-logo">
          <img src="images/flogo6.jpg" alt="canadaGovernment-logo">
          <img src="images/flogo7.png" alt="bcInnovationCouncil-logo">
        </div>
        <div class="supporterBottom">
          <img src="images/flogo8.png" alt="creativeLab-logo">
          <img src="images/flogo9.png" alt="cta-logo">
          <img src="images/flogo10.png" alt="mitas-logo">
          <img src="images/flogo11.png" alt="ctcn-logo">
          <div class="threeLogo">
            <img src="images/flogo12.png" alt="unep-logo">
            <img src="images/flogo13.png" alt="c-logo">
            <img src="images/flogo14.png" alt="unido-logo">
          </div>
        </div>
      </div>
      <div id="footerCopyRight">
        <p>© Eleos Robotics, Inc. All rights reserved.</p>
      </div>
      <div id="whiteBox"></div> <!--To hide blank line-->
    </footer>
</div>
</body>
</html>
