
</li>
                    
                    <li class="selected">
                        <a href="#"><?php echo $_SESSION['loginid'] ; ?> (Administrator)</a>
                    </li>
                    <li>
                        <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="admins.php"><i class="fa fa-user fa-fw"></i>Admins</a>
                    </li>
                    <li>
                        <a href="classes.php"><i class="fa fa-building-o fa-fw"></i>Classes</a>
                    </li>
                    <li>
                        <a href="users.php"><i class="fa fa-users fa-fw"></i>Users</a>
                    </li>
                    <li>
                        <a href="user_picture.php"><i class="fa fa-picture-o fa-fw"></i>Users Picture</a>
                    </li>
                    <li>
                        <a href="subjects.php"><i class="fa fa-book fa-fw"></i>Subjects</a>
                    </li>
                    <li>
                        <a href="test.php"><i class="fa fa-star fa-fw"></i>Test/Exam</a>
                    </li>
                    <li>
                        <a href="questions.php"><i class="fa fa-question-circle fa-fw"></i>Questions</a>
                    </li>
                    <li>
                        <a href="results.php"><i class="fa fa-file fa-fw"></i>Results</a>
                    </li>
                    <li>
                        <a href="promotion.php"><i class="fa fa-arrow-circle-right fa-fw"></i>Promotion</a>
                    </li>
                    <li>
                        <a href="logs.php"><i class="fa fa-trash-o fa-fw"></i>Logs</a>
                    </li>
                    <li>
                        <a href="manage_database.php"><i class="fa fa-wrench fa-fw"></i>Manage Database</a>
                    </li>
                    <li>
                        <a href="prints.php"><i class="fa fa-print fa-fw"></i>Print</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit fa-fw"></i>Edit Password/Sec Key<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="chgpswd.php">Edit Password</a>
                            </li>
                            <li>
                                <a href="chgscrt.php">Edit Secret Key</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                    </li>
                </ul>
                Software Edition: <b><?php echo $_SESSION['fedition'] ; ?></b>