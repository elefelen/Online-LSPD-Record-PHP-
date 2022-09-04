<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

        if(!isset($_SESSION["imie"], $_SESSION["nazwisko"], $_SESSION["nr_odznaki"], $_SESSION["admin"]))
        {
            header("location: index.php");
        }
    }
    include("./classes/DB.class.php");
    include("./functions/log-out-button.function.php");
    include("./classes/add-user.class.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="icon" href="./icons/icon.png">
    <title>Add a user - LSPD</title>
    <script src="./scripts/script.js"></script>
</head>
<body>
    <h1 class="lspd">Los Santos Police Department</h1>
    <?php
        logOutButton();
    ?>
    <div class="logo">
        <img id="logo" src="./icons/lspd.png">
    </div>
    <div class="container" id="container">
        <center><div class="log-in" id="log-in">
            <h1 id="h1">Add a user</h1><hr>
            <a href="menu.php" id="a2">Return to the main menu</a>
            <form action="" method="post" style="font-size: 22px; width: 350px; margin-top: 0;">
                <table>
                    <tr>
                        <td>Name: <input type="text" name="imie"></td>
                    </tr>
                    <tr>
                        <td>Last name: <input type="text" name="nazwisko"></td>
                    </tr>
                    <tr>
                        <td>Password: <input type="password" name="haslo"></td>
                    </tr>
                    <tr>
                        <td>Badge number: <input type="number" name="nr_odznaki"></td>
                    </tr>
                    <tr>
                        <td>Admin: <input type="checkbox" name="admin"></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                                if(isset($_POST["imie"], $_POST["nazwisko"], $_POST["haslo"], $_POST["nr_odznaki"]))
                                {
                                    if(!empty($_POST["imie"]) && !empty($_POST["nazwisko"]) && !empty($_POST["haslo"]) && !empty($_POST["nr_odznaki"]))
                                    {
                                        $addUser = new AddUser();
                                        $admin = 0;
                                        if(isset($_POST["admin"]))
                                        {
                                            $admin = 1;
                                        }
                                        else
                                        {
                                            $admin = 0;
                                        }
                                        $result = $addUser->add($_POST["imie"], $_POST["nazwisko"], $_POST["haslo"], $_POST["nr_odznaki"], $admin);
                                        if($result == "badge")
                                        {
                                            echo "<p style='color: red; font-size: 18px;'>This badge number is already in use!</p>";
                                        }
                                        if($result == "good")
                                        {
                                            echo "<p style='color: green; font-size: 18px;'>User added!</p>";
                                        }
                                        if($result == "err")
                                        {
                                            echo "<p style='color: red; font-size: 18px;'>Something went wrong!</p>";
                                        }
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Add" id="btn" style="margin-top: 5px;"></td>
                    </tr>
                </table>      
            </form>
            </div>     
        </div></center>
    </div>
    <div class="footer"></div>
</body>
</html>