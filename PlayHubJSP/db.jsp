
<%@ page import="java.sql.*" %>
<%
Connection conn = null;

try {
    Class.forName("com.mysql.cj.jdbc.Driver");

    conn = DriverManager.getConnection(
        "jdbc:mysql://localhost:3306/playhub",
        "root",
        ""
    );

    out.println("MySQL Database Connected Successfully!");
} catch (Exception e) {
    out.println("Database Connection Failed: " + e.getMessage());
}
%>
