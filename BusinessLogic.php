
<?php
include "database.php";
$bl = new BusinessLogic();

if(isset($_POST['spassword']) && isset($_POST['studentid']) || isset($_POST['employeeid']) && isset($_POST['epassword'])) {
    $bl->checkLoginCredentials();
}

if(isset($_POST['nssubmit'])){
    $bl->addNewStudent();
}
if(isset($_POST['nesubmit'])){
    $bl->addNewEmployee();
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
        if ($this->db->failedConnection) {
            http_response_code(500);
            include('Error500.php'); // provide your own HTML for the error page
            die();
        }

        $stmt = null;
        // STUDENT view
        if ($stuId && $stuPass) {
            $stmt = $this->db->prepare("Select contact.ID,Password, FROM Contact WHERE contact.id=? Password=? and contact.ID==student.ID");
            $stmt->bind_param($studentid, $spassword);
            $stmt->execute();
        } // admin view
        else {
            $stmt = $this->db->prepare("Select contact.ID,Password, FROM Contact WHERE contact.id=? Password=? and contact.ID==admin.ID");
            $stmt->bind_param($employeeid, $epassword);
            $stmt->execute();
            $this->student = false;
        }
        if ($stmt->get_result()->num_rows > 0) {
            if ($this->bl->student)
                header("location: newstudent.html");
            else
                header("location: newemployee.html");
        }
        else {
            header("Location: registrationform.html");
        }
    }

    public function addNewEmployee(){


        if ($this->db->failedConnection) {
            die("Failed SQL connection");
        }

        extract($_POST);

        $stmt=$this->db->prepare("SELECT ID FROM Contact WHERE ID=?");
        $stmt->bind_param($nemployeeeid);
        $stmt->execute();

        if($stmt.get_result()->num_rows>0){
            echo '<script type="text/javascript">
                window.alert("ID is already taken,please try again with a different ID.");
                window.location.href="newemployee.html.html"
                </script>';
        }

        /**
        $neName = $_POST['neName'] ?? false;
        $neLastName = $_POST['nelastname'] ?? false;
        $nemployeeeid = $_POST['nemployeeeid'] ?? false;
        $neestreetnumber = $_POST['neestreetnumber'] ?? false;
        $nestreetname = $_POST['nestreetname'] ?? false;
        $necity = $_POST['necity'] ?? false;
        $neprovince = $_POST['neprovince'] ?? false;
        $nepostalcode = $_POST['nepostalcode'] ?? false;
        $nemail = $_POST['nemail'] ?? false;
        $nephone = $_POST['nephone'] ?? false;
        $nedateofbirth = $_POST['nedateofbirth'] ?? false;
        $nepassword = $_POST['nepassword'] ?? false;
        **/

        $sql="INSERT INTO Contact(ID,Name,lastName,email,phoneNumber,dateOfBirth,streetNumber,streetName,city,postalCode,userType,numberOfCourses)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt =$this->db->prepare($sql);
        $stmt->bind_param($nemployeeeid, $neName,$neLastName,$nemail,$nephone,$nedateofbirth,$neestreetnumber,$necity,$nepostalcode,"admin",1);

        // Do we want a check to be sure it was actuall inserted into the db.
        $stmt->execute();

    }

    public function addNewStudent(){

        if ($this->db->failedConnection) {
            die("Failed SQL connection");
        }

        extract($_POST);

        $stmt=$this->db->prepare("SELECT ID FROM Contact WHERE ID=?");
        $stmt->bind_param($nstudentid);
        $stmt->execute();

        if($stmt->get_result()->num_rows>0){
            echo '<script type="text/javascript">
                window.alert("ID is already taken,please try again with a different ID.");
                window.location.href="newstudent.html"
                </script>';
        }

        /**
        $nsName = $_POST['nsName'] ?? false;
        $nsLastName = $_POST['nslastname'] ?? false;

        $nsestreetnumber = $_POST['nsestreetnumber'] ?? false;
        $nsstreetname = $_POST['nsstreetname'] ?? false;
        $nscity = $_POST['nscity'] ?? false;
        $nsprovince = $_POST['nsprovince'] ?? false;
        $nspostalcode = $_POST['nspostalcode'] ?? false;
        $nsmail = $_POST['nsmail'] ?? false;
        $nphone = $_POST['nphone'] ?? false;
        $nsdateofbirth = $_POST['nsdateofbirth'] ?? false;
        $nspassword = $_POST['nspassword'] ?? false;

**/
        $sql="INSERT INTO Contact(ID,Name,lastName,email,phoneNumber,dateOfBirth,streetNumber,streetName,city,postalCode,userType,numberOfCourses)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt =$this->db->prepare($sql);
        $stmt->bind_param($nstudentid, $nsName,$nsLastName,$nsmail,$nphone,$nsdateofbirth,$nsestreetnumber,$nscity,$nspostalcode,"student",1);
        $stmt->execute();

    }

    public function StudentCourseOptions()
    {
        if ($this->db->failedConnection) {
            die("Failed SQL connection");
        }
        extract($_POST);
        /**
        $courseOption=$_POST['courseOption'] ?? false;
        $stuId = $_POST['stuId'] ?? false;
        $courseCode = $_POST['courseCode'] ?? false;
        $semester = $_POST['semester'] ?? false;
        $days= $_POST['days'] ?? false;
        $timeOfDay = $_POST['time'] ?? false;
        $instructor = $_POST['instructor'] ?? false;
        $startDate = $_POST['startDate'] ?? false;
        $endDate = $_POST['endDate'] ?? false;
         **/
        if ($courseOption=="Add"){
            $stmt=$this->db->prepare("SELECT StartDate FROM courses WHERE courseCode=? and semester=? and ? between startDate and dateadd(week,1,startDate) and contact.numberOfCourses <5 and contact.id=xxx.id ");
            $stmt->bind_param($courseCode,$semester,$startDate);
            $stmt->execute();

            if($stmt.get_result()->num_rows==0)
            {
                return "Cannot add a course. Past the one week deadline";
            }
            else
                $stmt=$this->db->prepare("INSERT INTO XXX (courseCode,semester,instructor,studentId");
                $stmt->bind_param($courseCode,$semester,$instructor,$stuId);
                $stmt->execute();
                $stmt=$this->db->prepare("UPDATE contacts SET numberOfCourses=numberOfCouses+1 where ID=? and userType='Student'");
                $stmt->bind_param($stuId);
                $stmt->execute();
        }

        else
        {
            $stmt=$this->db->prepare("SELECT endDate FROM courses WHERE courseCode=? and semester=? and ? before endDate and studentId=?");
            $stmt->bind_param($courseCode,$semester,$startDate,$stuId);
            $stmt->execute();

            if($stmt.get_result()->num_rows==0)
            {
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

    public function adminAddCourse(){

        if ($this->db->failedConnection) {
            die("Failed SQL connection");
        }

        $courseCode = $_POST['courseCode'] ?? false;
        $courseTitle = $_POST['courseTitle'] ?? false;
        $semester = $_POST['semester'] ?? false;
        $days= $_POST['days'] ?? false;
        $timeOfDay = $_POST['time'] ?? false;
        $instructor = $_POST['instructor'] ?? false;
        $startDate = $_POST['startDate'] ?? false;
        $endDate = $_POST['endDate'] ?? false;
        $room = $_POST['room'] ?? false;
        $language = $_POST['language'] ?? false;
        $langLevel = $_POST['langLevel'] ?? false;

        $sql="INSERT INTO courses(CourseID,CourseTitle,semester,days,timeOfDay,instructor,room,startDate,endDate,Language,LangLevel)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt =$this->db->prepare($sql);
        $stmt->bind_params($courseCode,$courseTitle,$semester,$days,$timeOfDay,$instructor,$room,$startDate,$endDate,$language,$langLevel);
        $stmt->execute();

    }

    public function dbInit()
    {
        $db = new database();
//        $db->db_connect();
    }
}

/// STUDENT
/// send all post variables to student form
/// send it to the view
///
///
///