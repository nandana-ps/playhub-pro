
<%@ page import="java.sql.*" %>
<%
String idText = request.getParameter("id");

if (!"POST".equalsIgnoreCase(request.getMethod())) {
    response.sendError(405, "POST method required.");
    return;
}

if (idText == null || !idText.matches("\\d+")) {
    response.sendRedirect("registrations.jsp");
    return;
}

try {
    int id = Integer.parseInt(idText);

    Class.forName("com.mysql.cj.jdbc.Driver");

    Connection conn = DriverManager.getConnection(
        "jdbc:mysql://localhost:3306/playhub",
        "root",
        ""
    );

    PreparedStatement ps = conn.prepareStatement(
        "DELETE FROM registrations WHERE id = ?"
    );

    ps.setInt(1, id);
    ps.executeUpdate();

    ps.close();
    conn.close();

    response.sendRedirect("registrations.jsp");

} catch (Exception e) {
    out.println("Unable to delete registration: " + e.getMessage());
}
%>
