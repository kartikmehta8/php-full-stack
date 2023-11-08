<nav class="navbar navbar-light" style="background-color: #e3f2fd;" >
    <div class="container-fluid" >
        <div class="navbar-header"  >
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand" href="#">
                <strong style="color: black; font-size:25px">UNIT INVENTORY MANAGMENT SYSTEM</strong>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="admin_home.php"><?php echo ucwords($_SESSION['dept_name']). ' Home';?><span class="sr-only">(current)</span></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Items
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="items.php">Items List</a></li>
                        <?php
                        if($_SESSION['role'] == 'admin'){
                            echo '<li><a href="allocate.php?type=allocate">Allocate</a></li>';
							echo '<li><a href="allocate.php?type=return">Return</a></li>';
                           }
                        ?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View Allotment
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="view_list.php">All</a></li>
                        
                    </ul>
                </li>

                <?php
                //show oly if admin is logged in to the system
                if($_SESSION['role'] == 'admin')
                {
                   echo '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Stores
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        <li><a href="departments.php">Store List</a></li>
                        </ul>
                        </li>
                
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Vendors<span
                                class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="./suppliers.php">Vendors List</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a target="_new" href="./reports/daily.php">Daily</a></li>
                        <li><a href="#" target="_new">By Date</a></li>
                        <li><a href="#" target="_new">Monthly</a></li>
                        <li><a href="#" target="_new">By Supplier</a></li>
                        <li><a href="./reports/available_items_current_date.php" target="_new">By Availability</a></li>
                     </ul>
                </li>';
                }
                ?>

                <li class="dropdown">
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
                </li>
                <li class="text-success"><a href="./view_profile.php">Welcome <?php echo $_SESSION['dept_name'];  echo '&nbsp;&nbsp; '.date('h:i:sa');?></a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<hr>