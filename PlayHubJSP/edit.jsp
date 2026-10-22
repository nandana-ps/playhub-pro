
<%@ page import="java.sql.*" %>
<%
String idText = request.getParameter("id");
String name = "";
String email = "";
int age = 0;
String sport = "";

try {
    Class.forName("com.mysql.cj.jdbc.Driver");

    Connection conn = DriverManager.getConnection(
        "jdbc:mysql://localhost:3306/playhub", "root", ""
    );

    if ("POST".equalsIgnoreCase(request.getMethod())) {
        int id = Integer.parseInt(request.getParameter("id"));
        name = request.getParameter("name").trim();
        email = request.getParameter("email").trim();
        age = Integer.parseInt(request.getParameter("age"));
        sport = request.getParameter("sport");

        if (name.isEmpty() || age < 1
            || !email.matches("^[^@\\s]+@[^@\\s]+\\.[^@\\s]+$")
            || !java.util.Arrays.asList(
                "Football", "Cricket", "Badminton"
            ).contains(sport)) {
            out.println("Please enter valid details.");
            conn.close();
            return;
        }

        PreparedStatement ps = conn.prepareStatement(
            "UPDATE registrations SET name=?, email=?, age=?, sport=? WHERE id=?"
        );

        ps.setString(1, name);
        ps.setString(2, email);
        ps.setInt(3, age);
        ps.setString(4, sport);
        ps.setInt(5, id);
        ps.executeUpdate();

        ps.close();
        conn.close();

        response.sendRedirect("registrations.jsp");
        return;
    }

    int id = Integer.parseInt(idText);

    PreparedStatement ps = conn.prepareStatement(
        "SELECT * FROM registrations WHERE id=?"
    );

    ps.setInt(1, id);
    ResultSet rs = ps.executeQuery();

    if (rs.next()) {
        name = rs.getString("name");
        email = rs.getString("email");
        age = rs.getInt("age");
        sport = rs.getString("sport");
    } else {
        out.println("Registration not found.");
        rs.close();
        ps.close();
        conn.close();
        return;
    }

    rs.close();
    ps.close();
    conn.close();

} catch (Exception e) {
    out.println("Error: " + e.getMessage());
    return;
}
%>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Registration</title>
</head>
<body style="background:#111315;color:#eee;font-family:Arial;padding:30px">
    <h1 style="color:#c7f36b">Edit Registration</h1>

    <form method="POST" action="edit.jsp">
        <input type="hidden" name="id"
               value="<%= idText %>">

        <p>Name</p>
        <input name="name" value="<%= name %>" required>

        <p>Email</p>
        <input type="email" name="email"
               value="<%= email %>" required>

        <p>Age</p>
        <input type="number" name="age"
               value="<%= age %>" min="1" required>

        <p>Sport</p>
        <select name="sport" required>
            <option value="Football"
                <%= "Football".equals(sport) ? "selected" : "" %>>
                Football
            </option>
            <option value="Cricket"
                <%= "Cricket".equals(sport) ? "selected" : "" %>>
                Cricket
            </option>
            <option value="Badminton"
                <%= "Badminton".equals(sport) ? "selected" : "" %>>
                Badminton
            </option>
        </select>

        <p>
            <button type="submit">Save Changes</button>
        </p>
    </form>

    <a href="registrations.jsp" style="color:#c7f36b">
        Back to Registrations
    </a>
</body>
</html>
