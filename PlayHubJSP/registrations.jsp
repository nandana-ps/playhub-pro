<%@ page import="java.sql.*" %>
<%
String url = "jdbc:mysql://localhost:3306/playhub";
String dbUser = "root";
String dbPassword = "";
%>

<!DOCTYPE html>
<html>
<head>
    <title>PlayHub Pro | Registrations</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px;
            background: #111315;
            color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            color: #c7f36b;
            margin-bottom: 10px;
        }

        p {
            color: #a5a5a5;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .add-button {
            background: #c7f36b;
            color: #111315;
            padding: 11px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .table-container {
            background: #1b1e21;
            padding: 20px;
            border-radius: 12px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            color: #c7f36b;
            text-align: left;
            padding: 14px;
            border-bottom: 1px solid #363a3e;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #2c3034;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .edit-button {
            display: inline-block;
            background: #c7f36b;
            color: #111315;
            padding: 7px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
        }

        .delete-button {
            background: #dc5555;
            color: white;
            border: none;
            padding: 7px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
        }

        .delete-form {
            display: inline;
            margin-left: 5px;
        }

        .empty {
            text-align: center;
            color: #a5a5a5;
            padding: 25px;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: #c7f36b;
            text-decoration: none;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px;
            }

            .top {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="top">
        <div>
            <h1>Player Registrations</h1>
            <p>Manage all registered players in PlayHub Pro.</p>
        </div>

        <a href="register.jsp" class="add-button">
            + Add Registration
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Sport</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
            <%
            try {
                Class.forName("com.mysql.cj.jdbc.Driver");

                Connection conn = DriverManager.getConnection(
                    url, dbUser, dbPassword
                );

                Statement stmt = conn.createStatement();

                ResultSet rs = stmt.executeQuery(
                    "SELECT * FROM registrations"
                );

                boolean found = false;

                while (rs.next()) {
                    found = true;
            %>

                <tr>
                    <td><%= rs.getInt("id") %></td>

                    <td><%= rs.getString("name") == null ? "" :
                        rs.getString("name").replace("&", "&amp;")
                        .replace("<", "&lt;").replace(">", "&gt;")
                        .replace("\"", "&quot;").replace("'", "&#39;") %></td>

                    <td><%= rs.getString("email") == null ? "" :
                        rs.getString("email").replace("&", "&amp;")
                        .replace("<", "&lt;").replace(">", "&gt;")
                        .replace("\"", "&quot;").replace("'", "&#39;") %></td>

                    <td><%= rs.getInt("age") %></td>

                    <td><%= rs.getString("sport") == null ? "" :
                        rs.getString("sport").replace("&", "&amp;")
                        .replace("<", "&lt;").replace(">", "&gt;")
                        .replace("\"", "&quot;").replace("'", "&#39;") %></td>

                    <td>
                        <a class="edit-button"
                           href="edit.jsp?id=<%= rs.getInt("id") %>">
                            Edit
                        </a>

                        <form class="delete-form"
                              action="delete.jsp"
                              method="POST"
                              onsubmit="return confirm('Delete this registration?');">

                            <input type="hidden"
                                   name="id"
                                   value="<%= rs.getInt("id") %>">

                            <button type="submit" class="delete-button">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>

            <%
                }

                if (!found) {
            %>

                <tr>
                    <td colspan="6" class="empty">
                        No registrations found. Add your first player!
                    </td>
                </tr>

            <%
                }

                rs.close();
                stmt.close();
                conn.close();

            } catch (Exception e) {
            %>

                <tr>
                    <td colspan="6" class="empty">
                        Error loading registrations:
                        <%= e.getMessage() %>
                    </td>
                </tr>

            <%
            }
            %>
            </tbody>
        </table>
    </div>

    <a href="index.jsp" class="back-link">
        ← Back to Home
    </a>

</div>
</body>
</html>