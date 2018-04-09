<?php
    session_start();
    require_once('mysqli_connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Waiting List</title>
    <meta charset="utf-8">

    <!-- Eleos Tab Icon -->
    <link rel="icon" href="Images/eleosIcon.png">

    <!-- CSS Files -->
    <link rel="stylesheet" href="CSS/Base.css" type="text/css">
    
    <!-- Waiting list form validation -->
    <script type="text/javascript" src="js/WaitListValidation.js"></script>

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

        <div class="headerContent">
            <li class = "logo"><a href="index.html"><img src = "Images/logo.png" /></a></li>

            <ul class="blogs">
                <li><a href = "https://www.facebook.com/eleosrobotics/"><img src="Images/facebook.png"></a></li>
                <li><img src ="Images/linkedin.png"></li>
                <li><img src ="Images/twitter.png"></li>
            </ul>
            <ul class="navBar">
                <li><a href="TechnologyPage.html">OUR TECH</a></li>
                <li><a href="NewsPage.html" >NEWS</a></li>
                <li><a href="Calculator.html">CALCULATOR</a></li>
                <li><a href = "Aboutus.html">OUR TEAM</a></li>
                <li><a href = "ContactUs.html">CONTACT US</a></li>
                <li><a href = "Waitinglist.php">WAITINGLIST</a></li>
            </ul>

            <ul class="blogs">
                <li><a href = "https://www.facebook.com/eleosrobotics/"><img src="Images/facebook.png"></a></li>
                <li><img src ="Images/linkedin.png"></li>
                <li><img src ="Images/twitter.png"></li>
            </ul>

            <div class = "dropMenu">
            <li class = "logo"><a href="index.html"><img src = "Images/logo.png" /></a></li>
            <img class = "menuIcon" src = "Images/menuIcon.png">
                <div class = "dropdown-content">
                    <a href="TechnologyPage.html">OUR TECH</a>
                    <a href="NewsPage.html" >NEWS</a>
                    <a href="Calculator.html">CALCULATOR</a>
                    <a href = "Aboutus.html">OUR TEAM</a>
                    <a href = "ContactUs.html">CONTACT US</a>
                    <a href = "Waitinglist.php">WAITINGLIST</a>
                </div>
            </div>
        </div>

      <!-- Waiting list main Starts-->
      <div id="waitingMain">
        <div class="waitingheader">
            <h1>Waiting List</h1>
            <p>There's a demand for Culture bot and we currently have a waiting list for it. Place your name on the list if you're interested in purchasing Culture bot.</p>
        </div>

        <div class="userWait">
            <form name="waitForm" action="" onsubmit="return validateForm()" method="post">
                <div class="formWrap">
                <div class="leftForm2">
                <span class="contactText">First Name:<br></span>
                <input type="text" id="name1" name="firstName" placeholder="James"><br>
                <span class="contactText">Last Name:<br></span>
                <input type="text" id="last1" name="lastName">
                <br>
                <span class="contactText">Email:<br></span>
                <input type="text" id="email1" name="email" placeholder="example@mail.com">
                <br>
                <span class="contactText">Buisness:<br></span>
                
                <input type="text" id="business1" name="business">
                <br>
                    </div>
                    <div class="rightForm2">
                <span class="contactText">Farm:<br></span>
                <input type="text" id="farm1" name="farm">
                <br>
                <span class="contactText">Phone Number:<br></span>
                <input type="text" id="phone1" name="phoneNumber" placeholder="111-222-3333">
                <br>
                <span class="contactText">Address:<br></span>
                <input type="text" id="address1" name="address">
                <br>
                    </div>
                    </div>
                <input id="contactSubmit2" type="submit" value="Submit">
            </form>
        </div>
          
        <div class="waitingHeader2"><h2>Current people on the waiting list</h2></div>

        <?php
            if(isset($_POST['submit2']))
            {
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                $business = $_POST['business'];
                $farm = $_POST['farm'];
                $phoneNum = $_POST['phoneNumber'];
                $address = $_POST['address'];

                // Connecting to the database
                $list = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                // If we don't connect to the database it will spit out an error for us to fix
                if(!$list)
                {
                    die("Connection failed: ".mysqli_connect_error()); // Remove the connect_error method after done testing because of hacking issues.
                }

                $sql = "INSERT INTO WaitingList(id, firstName, lastName, email, business, farm, phoneNum, address) VALUES(NULL, '$firstName', '$lastName','$email', '$business', '$farm', '$phoneNum', '$address')";

                // Checking to see if we actually placed the data into the database
                if (!(mysqli_query($list, $sql)))
                {
                    echo "Error: " . $sql . "<br>" . mysqli_error($list). "<br>";
                }
                // Closing the connection to the database
                mysqli_close($list);
                header("Refresh:0");
            }
        ?>

        <div class="tableDiv">
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Business</th>
                    <th>Farm</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                </tr>
                <?php
                    // Connecting to the database
                    $list = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $row = mysqli_query($list, "SELECT * FROM WaitingList");

                    while($sqlRow = mysqli_fetch_assoc($row)){
                    ?>
                <tr>
                    <td><?php echo $sqlRow['firstName']; ?></td>
                    <td><?php echo $sqlRow['lastName']; ?></td>
                    <td><?php echo $sqlRow['email']; ?></td>
                    <td><?php echo $sqlRow['business']; ?></td>
                    <td><?php echo $sqlRow['farm']; ?></td>
                    <td><?php echo $sqlRow['phoneNum']; ?></td>
                    <td><?php echo $sqlRow['address']; ?></td>
                </tr>
                <?php
                    }
                    mysqli_close($list);
                ?>
            </table>
        </div>
    </div>

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
