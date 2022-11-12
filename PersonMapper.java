import java.sql.ResultSet;

public class PersonMapper {

    // ADD extra when we know what db looks like/ View
private final String insertSQL ="INSERT INTO railway.person(personalID,firstName,lastName,email,phoneNumber,dateOfBirth,streetName,streetNumber,city,country,postalCode)" +
        "        VALUES(?,?,?,?,?,?,?,?,?,?,?)";
    // Update and delete could be implemented but dont need to be done right now


    public ResultSet findById(Person person){return result;}

    public int insert(){return 1;}

}