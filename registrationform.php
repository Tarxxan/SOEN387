
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <link href="settings/reset.css" rel="stylesheet">
    <link href="settings/styles.css" rel="stylesheet"/>
    <link href="settings/formsstyles.css" rel="stylesheet"/>
    <title>Course&nbsp;registration&nbsp;site</title>
</head>
<body>

<div class="header">

    <h2>Register for courses</h2>
    <h2></h2></div>

<div class="navbar">
    <a href="home.html" onclick="processLogout()">Home</a>
</div>
<div>
    <label for="Courses">Courses</label>
    <form method="POST" action="BusinessLogic.php" target="_self">
        <select name="Courses">
            <?php
            include "businessLogic.php";
            $b=new BusinessLogic();
            $b->displayCoursesDropdown();
            ?>
        </select>
        <input type="submit" name="submit" value="sfsubmit"/>

    </form>

</div>

</body>