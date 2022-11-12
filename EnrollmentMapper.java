import java.sql.ResultSet;

public class EnrollmentMapper {


        private final String insertSQL ="INSERT INTO railway.courses(courseCode,title,semester,days,time,instructor,classroom,startDate,endDate,createdBy)" +
                "        VALUES(?,?,?,?,?,?,?,?,?,?)";
        private final String deleteSQL="DELETE FROM railway.enrollment WHERE courseCode=? AND studentID=?";
        // Update could be implemented but dont need to be done right now

        public ResultSet findById(Person person){return ;}

        public int insert(){return 1;}

    }
}

