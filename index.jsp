<%@ page import="com.example.demo.Person" %>
<%@ page import="com.example.demo.PersonMapper" %>
<%@ page import="java.sql.ResultSet" %>
<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>

<!DOCTYPE html>
<html>
<head>
  <title>JSP - Hello World</title>
</head>
<body>
<h1><%= "Hello World!" %></h1>
<br/>
<a href="Hello">Hello Servlet</a>
<h1><% Person person = new Person(); person.setPersonalID(12345678);%></h1>
<h1><% PersonMapper pm = new PersonMapper();
ResultSet rs =pm.findById(person);
%></h1>

</body>
</html>