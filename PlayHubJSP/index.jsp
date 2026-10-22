
<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html>
<head>
    <title>PlayHub Pro | JSP</title>
</head>
<body>
    <h1>Welcome to PlayHub Pro</h1>
    <p>My first JSP page is running successfully!</p>

    <%
        String name = "Nandana";
        out.println("<h2>Hello, " + name + "!</h2>");
    %>
</body>
</html>
