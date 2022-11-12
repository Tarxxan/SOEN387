import java.sql.ResultSet;

public class CoursesMapper {

    // ADD extra when we know what db looks like/ View
    private final String insertSQL ="INSERT INTO railway.courses(courseCode,title,semester,days,time,instructor,classroom,startDate,endDate,createdBy)" +
            "        VALUES(?,?,?,?,?,?,?,?,?,?)";
    // Update and delete could be implemented but dont need to be done right now


    public ResultSet findById(Courses courses){return result;}

    public int insert(){return 1;}


}
