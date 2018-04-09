<?php
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
    <link rel="stylesheet" href="CSS/results-page.css">

    <!-- For IE browser compatibility-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- For Respoinsive setting -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap-->
    <link href="CSS/bootstrap/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>
<body>

<div id="container"> <!--Put every thing from nav to footer-->

    <div class="headerContent">
        <li class="logo"><a href="index.html"><img src="Images/logo.png"/></a></li>

        <ul class="blogs">
            <li><a href="https://www.facebook.com/eleosrobotics/"><img src="Images/facebook.png"></a></li>
            <li><img src="Images/linkedin.png"></li>
            <li><img src="Images/twitter.png"></li>
        </ul>
        <ul class="navBar">
            <li><a href="TechnologyPage.html">OUR TECH</a></li>
            <li><a href="NewsPage.html">NEWS</a></li>
            <li><a href="Calculator.html">CALCULATOR</a></li>
            <li><a href="Aboutus.html">OUR TEAM</a></li>
            <li><a href="ContactUs.html">CONTACT US</a></li>
            <li><a href="Waitinglist.php">WAITINGLIST</a></li>
        </ul>

        <ul class="blogs">
            <li><a href="https://www.facebook.com/eleosrobotics/"><img src="Images/facebook.png"></a></li>
            <li><img src="Images/linkedin.png"></li>
            <li><img src="Images/twitter.png"></li>
        </ul>

        <div class="dropMenu">
            <li class="logo"><a href="index.html"><img src="Images/logo.png"/></a></li>
            <img class="menuIcon" src="Images/menuIcon.png">
            <div class="dropdown-content">
                <a href="TechnologyPage.html">OUR TECH</a>
                <a href="NewsPage.html">NEWS</a>
                <a href="Calculator.html">CALCULATOR</a>
                <a href="Aboutus.html">OUR TEAM</a>
                <a href="ContactUs.html">CONTACT US</a>
                <a href="Waitinglist.php">WAITINGLIST</a>
            </div>
        </div>
    </div>

    <div class="results">
        <!-- The results of the form input -->
        <?php

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
        $budget = setValue($_POST['annualBudget']); // Variable U
        $workExpense = determinePercentage($_POST['expense']);
        $machineExp = determinePercentage($_POST['expense2']);
        $phytoExp = determinePercentage($_POST['expense3']);
        $otherExp = determinePercentage($_POST['expense4']);

        function getAcres()
        {
            global $vegetables, $orchards, $berries, $vine, $herb, $other;
            $acres = $vegetables + $orchards + $berries + $vine + $herb + $other;
            return $acres;
        }

        function setValue($value)
        {
            if (!is_numeric($value))
                return 0;
            else
                return $value;
        }
		
		function determinePercentage($value) {
			if (is_numeric($value)) {
					return setValue($value);
			}
			else if (preg_match("/^\\d+%\$/", $value)) {
				return (setValue(intval($value)) / 100) * setValue($_POST['annualBudget']);
			}
		}

        $acres = getAcres();

        /*// Connecting to the database
        $list = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // If we don't connect to the database it will spit out an error for us to fix
        if (!$list) {
            die("Connection failed: " . mysqli_connect_error()); // Remove the connect_error method after done testing because of hacking issues.
        }

        mysqli_query($list, "CREATE TABLE IF NOT EXISTS Calculator(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
            , growType VARCHAR(11) NOT NULL
            , numAcres INT
            , vegetables INT
            , orchard INT
            , berries INT
            , vineyards INT
            , herbs INT
            , otherCult INT
            , hire BOOLEAN
            , workHire INT
            , workHours INT
            , annualBudget DOUBLE
            , workExpense DOUBLE
            , machineExpense DOUBLE
            , phytoExpense DOUBLE
            , otherExpense DOUBLE
            );");

        // Inserting in the Calculator table. It's long I know.
        $sql = "INSERT INTO Calculator (growType, numAcres, vegetables,orchards,berries,vineyards,herbs,otherCult,hire,workHire,workHours,annualBudget,workExpense,machineExpense,phytoExpense,otherExpense)
        VALUES ('$growType', $acres, $vegetables, $orchards, $berries, $vine, $herb, $other, '$hire', $workHire, $workHours, $budget, $workExpense, $machineExp, $phytoExp, $otherExp)";

        echo "<br>";

        // Checking to see if we actually placed the data into the database
        if (!(mysqli_query($list, $sql))) {
            echo "Error: " . $sql . "<br>" . mysqli_error($list) . "<br>";
            mysqli_close($list);
            die();
        }

        // Closing the connection to the database
        mysqli_close($list);*/

        /*
            The calculator part
        */
        $botPrice = 2000 / $acres; // variable A
        $cash = $budget - $botPrice;
        $acreSaving = $cash * $acres;

        $E = (($phytoExp - ($phytoExp / $budget) * $botPrice) * $acres);
        $F = ($phytoExp - ($phytoExp / $budget) * $botPrice);


        $H = (($workExpense - ($workExpense / $budget) * $botPrice) * $acres);
        $G = ($H / (($workExpense * $acres) / $workHire));
        $J = (((($workHours * 52) / $workHire) * $G) / 52);
        ?>
        <div class="slider">
            <div class="slide active">
                <div class="panel">
                    <?php
                    if ($cash > 0 || $acreSaving > 0) {
                        echo "<div class='top' data-back='SAVINGS'></div>";
                        echo "<div class='bottom' data-back='SAVINGS'></div>";
                    }
                    ?>
                </div>
                <div class="center">
                    <?php
                    if ($cash <= 0 && $acreSaving <= 0) {
                        echo "<h2>So we did some math, and it looks like you're already doing a great job keeping your'e weeding budget to a minimum. Consider using CultureBot to increase your crop yield.</h2>";
                    } else {
                        $roundCash = number_format($cash, 2);
                        $roundAcre = number_format($acreSaving, 2);
                        echo "<h2>So we did some math, and with CultureBot the amount you can save per year/acre compared to your current weeding process is:</h2>
                    <h2 class='resultCount'>\$$roundCash!</h2>";
                    }
                    ?>
                </div>
            </div>
            <?php
            if (!(($E <= 0) && ($F <= 0))) {
                echo "<div class='slide'>";
                $EE = number_format($E, 2);
                $FF = number_format($F, 2);
                echo "<div class='panel'>";
                echo "<div class='top' data-back='PHYTOSANITARY'></div>";
                echo "<div class='bottom' data-back='PHYTOSANITARY'></div>";
                echo "</div>";
                echo "<div class='center'>";
                echo "<h2>You can also save \$$EE on phystosanitary products yearly!(Equivalent to \$$FF year/acre)</h2>";
                echo "</div>";
                echo "</div>";
            }

            if (!(($H <= 0) && ($G <= 0) && ($J <= 0))) {
                echo "<div class='slide'>";
                $HH = number_format($H, 2);
                $GG = round($G, 0, PHP_ROUND_HALF_UP);
                $JJ = round($J, 0, PHP_ROUND_HALF_UP);
                echo "<div class='panel'>";
                echo "<div class='top' data-back='LABOUR'></div>";
                echo "<div class='bottom' data-back='LABOUR'></div>";
                echo "</div>";
                echo "<div class='center'>";
                //$JJ = round($J);
                echo "<h2>Last but not least, you can re-allocate or dismiss $GG workers, saving CAD $$HH yearly and a total of $$JJ hours weekly.</h2>";
                echo "</div>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
    <script>
        function nextSlide(){
            if ($('.active + .slide').length > 0){
                $('.active + .slide').addClass('active');
                $($('.active')[0]).removeClass('active');
            } else{
                $('.active').removeClass('active');
                $('.slide:nth-child(1)').addClass('active');
            }
        }

        $(document).on('click',nextSlide);
    </script>
    <!---Footer Start--->
<!--    <footer>-->
        <!--Supporters-->
        <!--<div id="footerSupporter">
            <div class="supporterTop">
                <img src="Images/flogo1.png" alt="growingFoward-logo">
                <img src="Images/flogo2.jpg" alt="investmentAgriculture-logo">
                <img src="Images/flogo3.png" alt="nrc-cnrc-logo">
                <img src="Images/flogo4.png" alt="nserc-crsng-logo">
                <img src="Images/flogo5.png" alt="britishColumbia-logo">
                <img src="Images/flogo6.jpg" alt="canadaGovernment-logo">
                <img src="Images/flogo7.png" alt="bcInnovationCouncil-logo">
            </div>
            <div class="supporterBottom">
                <img src="Images/flogo8.png" alt="creativeLab-logo">
                <img src="Images/flogo9.png" alt="cta-logo">
                <img src="Images/flogo10.png" alt="mitas-logo">
                <img src="Images/flogo11.png" alt="ctcn-logo">
                <div class="threeLogo">
                    <img src="Images/flogo12.png" alt="unep-logo">
                    <img src="Images/flogo13.png" alt="c-logo">
                    <img src="Images/flogo14.png" alt="unido-logo">
                </div>
            </div>
        </div>
        <div id="footerCopyRight">
            <p>© Eleos Robotics, Inc. All rights reserved.</p>
        </div>-->
<!--        <div id="whiteBox"></div> <!--To hide blank line-->-->
<!--    </footer>-->
</div>
</body>
</html>