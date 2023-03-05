<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

        <!--========== CSS ==========-->
        <link rel="stylesheet" href="../css/main.css">

        <title>Sacred Heart Medical Clinic</title>
    </head>
    <body>
        <?php
        session_start();

        if(isset($_SESSION["user"])) {
            if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
                header("location: ../login.php");
            } else{
                $useremail=$_SESSION["user"];
            }

        } else{
            header("location: ../login.php");
        }
        
        //DATE TODAY
        date_default_timezone_set('Asia/Manila');
        $today = date('Y-m-d');
        $newtoday = date('F-j-Y', strtotime($today));
        $day = date('D');

        //IMPORT DATABASE
        include("../connection.php");
        $userrow = $database->query("SELECT * FROM patient WHERE patient_email = '$useremail'");
        $userfetch = $userrow->fetch_assoc();
        $userid = $userfetch["patient_id"];
        $username = $userfetch["patient_name"];
        ?>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <a href="#" class="header__logo">Sacred Heart Medical Clinic</a>

                <span style="font-weight:500; color:#19181B;"><?php echo $day?>, <?php echo $newtoday?></span>   

                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>
            </div>
        </header>

        <!--========== NAV ==========-->
        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <div class="nav__list">
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Menu</h3>
    
                            <a href="#" class="nav__link active">
                                <i class='bx bx-home nav__icon' ></i>
                                <span class="nav__name">Dashboard</span>
                            </a>

                            <a href="#" class="nav__link">
                                <i class='bx bx-message-square-detail nav__icon'></i>
                                <span class="nav__name">Sessions</span>
                            </a>

                            <a href="#" class="nav__link">
                                <i class='bx bx-bookmark nav__icon' ></i>
                                <span class="nav__name">My Appointments</span>
                            </a>

                            <a href="#" class="nav__link">
                                <i class='bx bx-cog nav__icon' ></i>
                                <span class="nav__name">Settings</span>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="../logout.php" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <!--========== MAIN CONTENTS ==========-->
        <main>
            <h1 style="padding-bottom: 30px; font-size: 2.4vw;">Hello, <?php echo substr($username, 0, 13) ?>.</h1>
            <section style="padding: 20px 5% 20px;">
                <?php
                    $nextweek = date("Y-m-d", strtotime("+1 week"));
                    $sqlmain = "SELECT * FROM schedule INNER JOIN appointment ON schedule.schedule_id=appointment.schedule_id INNER JOIN patient ON patient.patient_id=appointment.patient_id INNER JOIN secretary ON schedule.secretary_id=secretary.secretary_id WHERE patient.patient_id=$userid AND schedule.schedule_date>='$today'ORDER BY schedule.schedule_date ASC";
                    $result = $database->query($sqlmain);
                        if($result->num_rows==0){
                            echo 
                            '<center>
                                <img src="../media/icons/dashboardnone.png" style="height: auto; max-width: 400px; width: 100%;">
                                <br>
                                <div class="p__dashboard">You have no bookings.</div>
                            </center>';
                            
                        } else {
                            for ($x=0; $x<$result->num_rows;$x++){
                                $row = $result->fetch_assoc();
                                $schedule_id = $row["schedule_id"];
                                $title = $row["title"];
                                $appointment_num = $row["appointment_num"];
                                $schedule_date = $row["schedule_date"];
                                $schedule_time = $row["schedule_time"];
                                
                                echo 
                                '
                                <table>
                                <thead>
                                  <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Job Title</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td data-head="First Name">James</td>
                                    <td data-head="Last Name">Matman</td>
                                    <td data-head="Job Title">Chief Sandwich Eater</td>
                                  </tr>
                                  <tr>
                                    <td data-head="First Name">The</td>
                                    <td data-head="Last Name">Tick</td>
                                    <td data-head="Job Title">Crimefighter Sorta</td>
                                  </tr>
                                </tbody>
                                </table>
                                ';  
                                }
                        }  
                ?>
            </section>
            <div class="TN bzz aHS-YH" style="margin-left:0px"><div class="qj qr"></div><div class="aio UKr6le"><span class="nU false"><a href="https://meet.google.com/new?hs=180&amp;authuser=0" target="_top" class="J-Ke n0" title="Start a meeting" aria-label="Start a meeting" draggable="false">Start a meeting</a></span></div><div class="nL aif"></div></div>
        </main>

        <!--========== MAIN JS ==========-->
        <script src="../main.js"></script>
    </body>
</html>