<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calculator</title>
    <meta charset="utf-8">
    
    <!-- Eleos Tab Icon -->
    <link rel="icon" href="Images/eleosIcon.png">

    <!-- CSS Files -->
    <link rel="stylesheet" href="CSS/Base.css" type="text/css">

</head>
<body>
    
<div id="container"> <!--Put every thing from nav to footer-->

    <nav>
        <li><a href="Index.html">Home</a></li>
        <li><a href="Waitinglist.html">Waiting List</a></li>
        <li><a href="TechnologyPage.html">Our Technology</a></li>
        <li><a href="NewsPage.html">News</a></li>
        <li><a href="Aboutus.html">About Us</a></li>
        <li><a href="ContactUs.html">Contact Us</a></li>
        <li><a href="Calculator.html">Calculator</a></li>
    </nav>

    <!-- The results of the form input -->
    <?php    
        echo "Growing Type: ".$_POST['growingType']."<br>";
        echo "Number of acres: ".$_POST['acres']."<br>";
        echo "Vegtables cultivated: ".$_POST['cultivate']."<br>";
        echo "Orchards cultivated: ".$_POST['cultivate2']."<br>";
        echo "Berries cultivated: ".$_POST['cultivate3']."<br>";
        echo "Vineyards cultivated: ".$_POST['cultivate4']."<br>";
        echo "Herbs cultivated: ".$_POST['cultivate5']."<br>";
        echo "Others cultivated: ".$_POST['cultivate6']."<br>";
        echo "Do you hire people for weeding? ".$_POST['weeding']."<br>";
        echo "Number of workers hired: ".$_POST['workers']."<br>";
        echo "Hours total for weeding for workers: ".$_POST['weeklyWorkers']."<br>";
        echo "Annual budget: $".$_POST['annualBudget']."<br>";
        echo "Workers expenses: $".$_POST['expense']."<br>";
        echo "Machinery expenses: $".$_POST['expense2']."<br>";
        echo "Phytosanitary expenses: $".$_POST['expense3']."<br>";
        echo "Other expenses: $".$_POST['expense4']."<br>";
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
    ?>
    
    <!-- The calculator part -->
    
    <?php
        $botPrice = 10000; // variable A
        $budget = $_POST['annualBudget']; // variable U
        $cash = $budget - $botPrice;
        $arces = $_POST['acres']; // variavle R
        $acreSaving = $cash * $arces;
    
        if(($cash <= 0) && ($acreSaving <= 0)) {
            echo "It looks like you are doing a great job keeping you weeding budget to a minimum. Please consider Culture Bot to increase your crop yield<br>";
        } else {
            echo "Congratulations! With Culturebot, you can sav CAD $cash per year compated to your current weeding process!(Equivalent to CAD $acreSaving /year/acre)<br>";
        }
    
        $phytosanitary = $_POST['expense3']; // variable m
        $E = ((($budget - $phytosanitary) / ($budget * $botPrice)) * $arces);
        $F = (($budget - $phytosanitary) / ($budget * $botPrice));
        if(!(($E <= 0) && ($F <= 0))) {
            echo "You can also save CAD $E on phystosanitary products yearly!(Equivalent to CAD $F year/acre)<br>";
        }
        $workers = $_POST['expense']; // variable k
        $workerBudget = $_POST['workers']; // variable S
        $workerHours = $_POST['weeklyWorkers'];
        $H = (($budget - $workers) / ($budget * $botPrice) * $arces);
        $G = ($H / (($workers * $arces) / $workerBudget));
        $J = (((($workerHours * 52) / $workerBudget) * $G) / 52);
    
        if(!(($H <= 0) && ($G <= 0) && ($J <= 0))) {
            echo "Last but not least, you can re-allocate or dismiss $G workers, saving CAD $H yearly and a total of $J hours weekly.<br>";
        }
    ?>
   
<!---Footer Start--->
<footer>
  <!--Logo-->
  <div id="footerLogo">
    <a href="Index.html"><img src="Images/logo.png" alt="company-logo"></a>
    <p>© Eleos Robotics, Inc. All rights reserved.</p>
  </div>

  <!--Links for each page, unknown content -->
  <div id="footerMid">
    <table>
      <tr >
        <th><a href="TechnologyPage.html">Technology</a></th>
        <th><a href="Waitinglist.html">Waiting List</a></th>
        <th><a href="#">About us</a></th>
        <th><a href="ContactUs.html">Contact Us</a></th>
      </tr>
      <tr>
        <td>
          <p>Description about Technology page.</p>
        </td>
        <td>
          <p>Description about Waiting list page.</p>
        </td>
        <td>
          <p>Description about About us page.</p>
        </td>
        <td>
        <p>Description about Contact us page.</p>
        </td>
      </tr>
    </table>

    <div id="footerSupporter">
      <!--Contents is filled out later-->
    </div>
  </div>

  <div id="footerRight">
    <!--Company Information-->
      <ul>
        <li><span class="fInforHead">Address:</span></li>
        <li>301-3007 Glen Drive, Coquitlam,<br>BC V3B 0L8 CANADA</li>
        <li><span class="fInforHead">E-mail:</span> info@eleosrobotics.com</li>
        <li><span class="fInforHead">Phone:</span> +1 (604) 500-2834</li>
        <li><span class="fInforHead">SNS:</span></li>
      </ul>
      <div id="footerSns">
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.facebook.com/eleosrobotics/" target="_blank">
          <img src="Images/facebook.png" alt="Share on Facebook" /></a>

        <a href="https://www.linkedin.com/shareArticle?mini=true&url={https://www.linkedin.com/company/eleos-robotics-inc.}&title={Eleos Robotics}&summary={articleSummary}&source={articleSource}" target="_blank">
          <img src="Images/linkedin.png" alt="Share on Lniked in" /></a>

        <a href="http://twitter.com/home?status=Eleos%20Robotics" target="_blank">
          <img src="Images/twitter.png" alt="Share on Twitter" /></a>
      </div>
  </div>
</footer>    

</div>
</body>
</html>