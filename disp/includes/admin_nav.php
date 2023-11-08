<nav class="navbar navbar-light" style="background-color: floralwhite;" >
    <div class="container-fluid" style="height:700px;">
        <div class="navbar-header"  >
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <img height="150px;" width="1055px" src="echs.png">

        


           <div >
            <ul class="nav navbar-nav navbar-right">
                </li>
                <li class="text-success" style="font-size:20px; "><a href="./admin_home.php">Welcome <?php echo $_SESSION['dept_name'];  echo '&nbsp;&nbsp; '.date('h:i:sa');?></a></li>
                <li style="font-size:20px;"><a href="logout.php">Logout</a></li></ul>
               

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <ul>
                <li class="dropdown" style="font-size: 30px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Medicine Details
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="items.php">Medicine List</a></li>
                        <?php
                        if($_SESSION['role'] == 'admin'){

                            echo '<li><a href="allocate.php?type=allocate">Allocate</a></li>';
							//echo '<li><a href="allocate.php?type=return">Return</a></li>';
                           }
                        ?>

                    </ul>
                </li>
                <br>
                <li class="dropdown" style="font-size: 30px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Allotment of medicine
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="view_list.php">All</a></li>
                        
                    </ul>
                </li>
                <br>
                <?php
                //show oly if admin is logged in to the system
                if($_SESSION['role'] == 'admin')
                {
                   echo '<li class="dropdown" style="font-size: 30px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Units/Sub-Units
                        <span class="caret"></span></a>
                       <ul class="dropdown-menu" role="menu">
                        <li><a href="departments.php">Units/Sub-Units</a></li>
                        </ul>
                        </li>
                        <br>

                        <li class="dropdown" style="font-size: 30px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Medicine Status of Units/Sub-Units<span class="caret"></span></a>
                       <ul class="dropdown-menu" role="menu">
                        <li><a href="view_list1.php">Total</a></li>
                        <li ><a href="view_data.php">Monthly</a></li>
                        </ul>
                        </li>
                       
                        <br>
                
                    <li class="dropdown" style="font-size: 30px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pharma Coys<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="./suppliers.php">Pharmaceutical coy list</a></li>
                    </ul>
                </li>
                ';
                }
                ?>
                <br>
                <!--<li class="dropdown" style="font-size: 30px;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="view_profile.php">View Profile</a></li>
                        <li><a href="change_pass.php">Change Password</a></li>
                        <?php
                        //show only if admin is logged in to the system
                        // $manual = 'user_manual.docx';
                        if($_SESSION['role'] == 'admin')
                        {
                            //file name
                            $manual = 'how_to_install.txt';
                            echo'<li><a href="forgot_pass.php">Reset Department Password</a></li>';
                            echo'<li><a href="backup.php">Create Backup</a></li>';
                            echo'<li><a href="./actions/download.php?download_file='.$manual.'" download>Users Manual</a></li>';
                        }
                        ?>
                        </ul>
                        
                        </li>-->
                        <br>
                        <br>
                        <br>
                        <br>
                        
                       
                        
                        
                    
               



                    </ul>
                    
            </ul>
        </div>
        <div>
            
    </div>
</nav>
<hr>