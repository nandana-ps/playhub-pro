
<%@ page import="java.sql.*" %>
<!DOCTYPE html>
<html>
<head>
    <title>PlayHub Pro | Register</title>
    <style>
        body {
            background: #111315;
            color: #eeeeee;
            font-family: Arial, sans-serif;
            padding: 40px 20px;
        }

        .card {
            max-width: 420px;
            margin: auto;
            background: #1b1e21;
            padding: 28px;
            border: 1px solid #303438;
            border-radius: 12px;
        }

        h1 {
            color: #c7f36b;
        }

        label {
            display: block;
            margin-top: 18px;
        }

        input, select {
            width: 100%;
            padding: 11px;
            margin-top: 7px;
            box-sizing: border-box;
            background: #111315;
            color: white;
            border: 1px solid #393d41;
            border-radius: 6px;
        }

        button {
            margin-top: 22px;
            padding: 12px;
            width: 100%;
            background: #c7f36b;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        a {
            color: #c7f36b;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>PlayHub Pro</h1>
    <h2>Sports Registration</h2>

    <form method="POST" action="register.jsp">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Age</label>
        <input type="number" name="age" min="1" required>

        <label>Sport</label>
        <select name="sport" required>
            <option value="">Select Sport</option>
            <option value="Football">Football</option>
            <option value="Cricket">Cricket</option>
            <option value="Badminton">Badminton</option>
        </select>

        <button type="submit">Register</button>
    </form>

    <p><a href="registrations.jsp">View Registrations</a></p>

    <%
    if ("POST".equalsIgnoreCase(request.getMethod())) {
        String name = request.getParameter("name");
        String email = request.getParameter("email");
        String ageText = request.getParameter("age");
        String sport = request.getParameter("sport");

        if (name != null && email != null && ageText != null
            && sport != null) {
            try {
                int age = Integer.parseInt(ageText);

                if (name.trim().isEmpty() || age < 1
                    || !email.matches("^[^@\\s]+@[^@\\s]+\\.[^@\\s]+$")
                    || !java.util.Arrays.asList(
                        "Football", "Cricket", "Badminton"
                    ).contains(sport)) {
                    out.println("<p>Please enter valid details.</p>");
                } else {
                    Class.forName("com.mysql.cj.jdbc.Driver");

                    Connection conn = DriverManager.getConnection(
                        "jdbc:mysql://localhost:3306/playhub",
                        "root",
                        ""
                    );

                    PreparedStatement ps = conn.prepareStatement(
                        "INSERT INTO registrations (name, email, age, sport) VALUES (?, ?, ?, ?)"
                    );

                    ps.setString(1, name.trim());
                    ps.setString(2, email.trim());
                    ps.setInt(3, age);
                    ps.setString(4, sport);

                    int result = ps.executeUpdate();

                    if (result > 0) {
                        out.println("<p>Registration successful!</p>");
                    }

                    ps.close();
                    conn.close();
                }
            } catch (NumberFormatException e) {
                out.println("<p>Please enter a valid age.</p>");
            } catch (Exception e) {
                out.println("<p>Registration failed: "
                    + e.getMessage() + "</p>");
            }
        }
    }
    %>
</div>

</body>
</html>
