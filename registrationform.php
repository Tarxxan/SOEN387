<?php
include "businessLogic.php";
$b = new BusinessLogic(); ?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <link href="settings/reset.css" rel="stylesheet">
    <link href="settings/styles.css" rel="stylesheet"/>
    <link href="settings/formsstyles.css" rel="stylesheet"/>
    <title>Course&nbsp;enrollment</title>
</head>
<body>
<div class="page-container">
    <div class="header">
        <h1>Student site</h1>
        <h2>Course enrollment</h2>
    </div>

    <div class="navbar">
        <a class="right" href="home.html" onclick="processLogout()">Logout</a>
        <a class="active" href="registrationform.php">Enrollment</a>

    </div>

    <div class="content-wrapper w-container">

        <div class="row card">


            <div class="column">
                <form method="POST" action="BusinessLogic.php" target="_self">

                    <div class="form-group">

                        <label for="addCourse" class="center-box">Enroll</label>
                        <select id="addCourse" name="addCourse">
                            <?php
                            $b->displayCoursesDropdown();
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="sfsubmit" value="Add Course"/>
                </form>

            </div>
            <div class="column">
                <form method="POST" action="BusinessLogic.php" target="_self">
                    <div class="form-group">
                        <label for="dropCourse" class="center-box">Drop</label>
                        <select id="dropCourse" name="dropCourse">
                            <?php
                            $b->courseById();
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="sdsubmit" value="Drop Courses"/>
                </form>

            </div>
        </div>

        <div class="row">
            <?php
            $b->displayCoursesTable();
            ?>
        </div>

    </div>

    <footer class="footer">


    </footer>
</div>
</body>


</html>