<?php
include "database.php";
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$bl = new BusinessLogic();


if(isset($_POST['nslogin']) || isset($_POST['nelogin'])) {
    $bl->checkLoginCredentials();

}

if(isset($_POST['nssubmit'])){
    $bl->addNewStudent();
}
if(isset($_POST['nesubmit'])){
    $bl->addNewEmployee();
}

if(isset($_POST['ncsubmit'])){
    $bl->adminAddCourse();
}

if(isset($_POST['sfsubmit'])){
    $bl->studentRegisterCourse();
}

class BusinessLogic
{
    public $student;
    public $db;

    public function __construct()
    {
        $this->db=$this->dbInit();
        $this->student=true;
    }

    public function checkLoginCredentials()
    {
        extract($_POST);
        // Need to tweak this and the db connection
//        if ($this->db->failedConnection) {
//            http_response_code(500);
//            include('Error500.php'); // provide your own HTML for the error page
//            die();
//        }

        // Checks the database for a matching ID in the corresponding tables.
        if ($studentid) {
            $stmt = $this->db->prepare("Select studentID FROM railway.student WHERE studentID=?");
            $stmt->bindParam(1, $studentid);
            $stmt->execute();
            $_SESSION['id']=$studentid;
        }

        else {
            $stmt = $this->db->prepare("Select employeeID FROM railway.employee WHERE employeeID=?");
            $stmt->bindParam(1,$employeeid);
            $stmt->execute();
            $this->student = false;
            $_SESSION['id']=$employeeid;
        }

        // Returns an associative array or false. Hence the !result== no results found in the database
        $result=$stmt->fetch(PDO::FETCH_ASSOC);

        //Redirection checks for both students and admins
        if (!$result && $this->student) {
             header("location: newstudent.html");
        }

        elseif (!$result && !($this->bl->student) && isset($employeeid)) {
            echo '<script type="text/javascript">
            window.alert("Contact HR to make an admin acconut");
            window.location.href="home.html"</script>';
        }

        else{
            if($this->student)
                header("Location: registrationform.html");
            else {

                header("Location: newcourse.html");
            }
        }
    }

    public function addNewEmployee(){

        extract($_POST);

        //Checks the db if the given id is being used
        $stmt=$this->db->prepare("SELECT person.personalID FROM railway.person 
                                            LEFT JOIN railway.employee ON employee.employeeID=person.personalID
                                            LEFT JOIN railway.student ON person.personalID=student.studentID
                                            WHERE employee.employeeID=? OR student.studentID =?");
        $stmt->bindParam(1,$nemployeeid);
        $stmt->bindParam(2,$nemployeeid);
        $stmt->execute();

        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);


        if($result){
            echo '<script type="text/javascript">
                window.alert("ID is already taken,please try again with a different ID.");
                window.location.href="newemployee.html"
                </script>';
        }

        // Both table INSERTS since they are all connected
        $sql="INSERT INTO railway.person(personalID,firstName,lastName,email,phoneNumber,dateOfBirth,streetName,streetNumber,city,country,postalCode)
        VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt =$this->db->prepare($sql);
        $bind=array($nemployeeid,$nename,$nelastname,$nemail,$nephone,$nedateofbirth,$nestreetname,$neestreetnumber,$necity,$necountry,$nepostalcode);
        $stmt=$this->bindAll($stmt,$bind);
        $stmt->execute();

        $sql="INSERT INTO railway.employee(employeeID,personalID)VALUES(?,?)";
        $stmt =$this->db->prepare($sql);
        $bind=array($nemployeeid,$nemployeeid);
        $stmt=$this->bindALl($stmt,$bind);
        $stmt->execute();

        // REDIRECT PAGE TO CREATE A RPEORT OR TO ADD COURSES( CAROLINA)
        header("location: reports.html");

    }
    
    public function addNewStudent(){

        extract($_POST);

        //Checks the db if the given id is being used
        $stmt=$this->db->prepare("SELECT person.personalID FROM railway.person 
                                            LEFT JOIN railway.employee ON employee.employeeID=person.personalID
                                            LEFT JOIN railway.student ON person.personalID=student.studentID
                                            WHERE employee.employeeID=? OR student.studentID =?");
        $stmt->bindParam(1,$nstudentid);
        $stmt->bindParam(2,$nstudentid);
        $stmt->execute();

        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            echo '<script type="text/javascript">
                window.alert("ID is already taken,please try again with a different ID.");
                window.location.href="newemployee.html"
                </script>';
        }

        $sql="INSERT INTO railway.person(personalID,firstName,lastName,email,phoneNumber,dateOfBirth,streetName,streetNumber,city,country,postalCode)
        VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt =$this->db->prepare($sql);
        $bind=array($nstudentid,$nsname,$nslastname,$nsemail,$nphone,$nsdateofbirth,$nsstreetname,$nsestreetnumber,$nscity,$nscountry,$nspostalcode);
        $stmt=$this->bindAll($stmt,$bind);
        $stmt->execute();

        $sql="INSERT INTO railway.student(studentID,personalID)VALUES(?,?)";
        $stmt =$this->db->prepare($sql);
        $bind=array($nstudentid,$nstudentid);
        $stmt=$this->bindALl($stmt,$bind);
        $stmt->execute();

        // REDIRECT PAGE TO CREATE ADD COURSES( CAROLINA)
        header("location: reports.html");
    }

    public function adminAddCourse(){

        extract($_POST);
        extract($_SESSION);

        $comp=strcmp($_POST['startDate'],$_POST['endDate']);

        if($comp==0 || $comp >0){
            echo '<script type="text/javascript">
                window.alert("Start and End dates are incorrect, please verify before re-submitting");
                window.location.href="newcourse.html"
                $_POST=null;
                </script>';
        }

        $sql="INSERT INTO railway.courses(courseCode,title,semester,days,time,instructor,classroom,startDate,endDate,createdBy)
        VALUES(?,?,?,?,?,?,?,?,?,?)";
        $stmt =$this->db->prepare($sql);
        $binds=array($courseCode,$courseTitle,$semester,$days,$time,$instructor,$room,$startDate,$endDate,$id);
        $stmt= $this->bindAll($stmt,$binds);
        try {
            $stmt->execute();
        }
        catch(PDOException $e) {
            echo '<script type="text/javascript">
                window.alert("Course code already exist, try another one");
                window.location.href="newcourse.html"
                </script>';
        }
        header("location: newcourse.html");

    }

    public function studentRegisterCourse
    {

    }

    public function StudentCourseOptions()
    {
        if ($this->db->failedConnection) {
            die("Failed SQL connection");
        }
        extract($_POST);

        if ($courseOption=="Add"){
            $stmt=$this->db->prepare("SELECT StartDate FROM courses WHERE courseCode=? and semester=? and ? between startDate and dateadd(week,1,startDate) and contact.numberOfCourses <5 and contact.id=xxx.id ");
            $stmt->bind_param($courseCode,$semester,$startDate);
            $stmt->execute();
            if($stmt.get_result()->num_rows==0) {
                return "Cannot add a course. Past the one week deadline";
            }
            else {
                $stmt=$this->db->prepare("INSERT INTO XXX (courseCode,semester,instructor,studentId");
                $stmt->bind_param($courseCode,$semester,$instructor,$stuId);
                $stmt->execute();
                $stmt=$this->db->prepare("UPDATE contacts SET numberOfCourses=numberOfCouses+1 where ID=? and userType='Student'");
                $stmt->bind_param($stuId);
                $stmt->execute();
            }
        }
        else {
            $stmt=$this->db->prepare("SELECT endDate FROM courses WHERE courseCode=? and semester=? and ? before endDate and studentId=?");
            $stmt->bind_param($courseCode,$semester,$startDate,$stuId);
            $stmt->execute();

            if($stmt.get_result()->num_rows==0) {
                return "Cannot drop the course.";
            }

            $stmt=$this->db->prepare("DELETE FROM XXX WHERE courseCode=? and semester=? and instructor=? and timeOfDay=? and studentId=?");
            $stmt->bind_param($courseCode,$semester,$instructor,$timeOfDay,$stuId);
            $stmt->execute();
            $stmt=$this->db->prepare("UPDATE contacts SET numberOfCourses=numberOfCouses-1 where ID=? and userType='Student'");
            $stmt->bind_param($stuId);
            $stmt->execute();
        }
    }



    // Change to course params when we get the db
    public function displayCoursesTable(){
        $sql="SELECT courseCode as 'Course Code' ,title as 'Title',instructor as 'Instructor',startDate as 'Start Date',endDate as 'End Date' ";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch_all(MYSQLI_ASSOC);
        if ($result->num_rows() >0) {
            echo "<table>";
            echo "<tr>";
                echo "<th>id</th>";
                echo "<th>first_name</th>";
                echo "<th>last_name</th>";
                echo "<th>email</th>";
            echo "</tr>";

            foreach ($result as $row){
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }


    public function displayCoursesDropdown()
    {
        $sql="SELECT courseCode as 'Course Code' FROM railway.courses";
        $stmt =$this->db->query($sql);

        while($row=$stmt->fetch()){
            echo "<option value=".  $row['Course Code'].">".$row['Course Code']."</option>";
        }


    }
    /** Either this redirects you to the page with just that report on it or we would need to use jquery but i dont think
    thats allowed yet so lets redirect to two diff pages. Or we can hide them with js and show when we click a button */
    public function displayReport($reportType){
        if($reportType == "courses") {
            $sql="";
        }
        else {
            $sql="";
        }
        $stmt =$this->db->query($sql);
        $result = $stmt->fetch_all(MYSQLI_ASSOC);

        if ($result->num_rows() >0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>id</th>";
            echo "<th>first_name</th>";
            echo "<th>last_name</th>";
            echo "<th>email</th>";
            echo "</tr>";

            foreach ($result as $row){
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    public function bindALl($stmt,$arr){
        for($i=0;$i<count($arr);$i++){
            $stmt->bindParam($i+1,$arr[$i]);
        }
        return $stmt;
    }

    public function dbInit()
    {
        $db = new database();
        return $db->db_connect();

    }
}
