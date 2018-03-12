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
            <li><a href="NewsPage.html">News</a></li>
            <li><a href="TechnologyPage.html">Our Technology</a></li>
            <li><a href="NewsPage.html">News</a></li>
            <li><a href="Calculator.html">Calculator</a></li>
            <li><a href="ContactUs.html">Contact Us</a></li>
        </nav>

        <div class="listHeader">
            <h1>Page heading a with nice background image</h1>
        </div>

      <!-- Waiting list main Starts-->
      <div id="waitingMain">
        <div class="waitingheader">
            <h1>Header</h1>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
        </div>

        <div class="userWait">
            <form name="waitForm" action="" onsubmit="return validateForm()" method="post">
                Name:<br>
                <input type="text" id="name1" name="firstName" placeholder="James"><br>
                Email:<br>
                <input type="text" id="email1" name="email" placeholder="example@mail.com">
                <br>
                <input id="calSubmit" type="submit" name="submit2" value="Submit">
            </form>
        </div>

        <?php
            if(isset($_POST['submit2']))
            {
                $firstName = $_POST['firstName'];
                $email = $_POST['email'];

                // Connecting to the database
                $list = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                // If we don't connect to the database it will spit out an error for us to fix
                if(!$list)
                {
                    die("Connection failed: ".mysqli_connect_error()); // Remove the connect_error method after done testing because of hacking issues.
                }

                $sql = "INSERT INTO WaitingList(id, firstName, email) VALUES(NULL, '$firstName', '$email')";

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
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                <?php
                    // Connecting to the database
                    $list = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                    $row = mysqli_query($list, "SELECT * FROM WaitingList");

                    while($sqlRow = mysqli_fetch_assoc($row)){
                    ?>
                <tr>
                    <td><?php echo $sqlRow['firstName']; ?></td>
                    <td><?php echo $sqlRow['email']; ?></td>
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
        <img src="images/supporter.png" alt="supporter-logos">
      </div>
      <div id="footerCopyRight">
        <p>© Eleos Robotics, Inc. All rights reserved.</p>
      </div>
    </footer>
    </div>

    <script>
        function validateForm() {
            var xV = document.forms["waitForm"]["firstName"];
            var yV = document.forms["waitForm"]["email"];
            var x = document.forms["waitForm"]["firstName"].value;
            var y = document.forms["waitForm"]["email"].value;
            if (x == "") {
                alert("Name must be filled out")
                xV.focus();
                return false;
            }
            else if(y == ""){
                alert("email must be filled out")
                yV.focus();
                return false;
            }else{
                if(ValidateEmail(document.waitForm.email) == false){
                    yV.focus();
                    return false;
                } else {
                    return true;
                }
            }
        }

        function ValidateEmail(mail)
        {
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(mail.value.match(mailformat))
            {
            return true;
            }
            else
            {
            alert("You have entered an invalid email address!");
            return false;
            }
        }
    </script>
</body>
</html>
