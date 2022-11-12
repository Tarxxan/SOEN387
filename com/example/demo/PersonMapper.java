package com.example.demo;

import com.example.demo.DBConnection;

import java.sql.*;

public class PersonMapper {

    // ADD extra when we know what db looks like/ View
private final String insertSQL ="INSERT INTO railway.person(personalID,firstName,lastName,email,phoneNumber,dateOfBirth,streetName,streetNumber,city,country,postalCode)" +
        "        VALUES(?,?,?,?,?,?,?,?,?,?,?)";
    // Update and delete could be implemented but dont need to be done right now


    public ResultSet findById(Person person) throws SQLException {
        Connection conn = DBConnection.getConnection();
        String query="SELECT * FROM railway.PERSON where personalID=?";
        PreparedStatement stmt = conn.prepareStatement(query);

        stmt.setInt(1,person.getPersonalID());

        ResultSet rs= stmt.executeQuery();

        while(rs.next()) {
            System.out.print("First Name: "+rs.getString("firstName")+", ");
            System.out.print("Last Name: "+rs.getString("lastName")+", ");
            System.out.print("Date of Birth: "+rs.getDate("dateOfBirth"));
            System.out.println();
        }

        return rs;}

    public int insert(){return 1;}

}