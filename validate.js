function validateForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let age = document.getElementById("age").value;
    let sport = document.getElementById("sport").value;

    if (name === "") {
        alert("Enter your name");
        return false;
    }

    if (email === "" || !email.includes("@") || !email.includes(".")) {
        alert("Enter a valid email");
        return false;
    }

    if (age === "" || age < 1 || age > 100) {
        alert("Enter a valid age");
        return false;
    }

    if (sport === "") {
        alert("Select a sport");
        return false;
    }

    return true;
}