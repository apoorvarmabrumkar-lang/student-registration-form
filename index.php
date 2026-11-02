
<?php
$name = $email = $phone = $gender = $course = $address = "";
$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $gender = $_POST["gender"];
    $course = $_POST["course"];
    $address = trim($_POST["address"]);

    if (
        $name == "" || $email == "" || $phone == "" ||
        $gender == "" || $course == "" || $address == ""
    ) {
        $error = "Please fill all the fields.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    }
    elseif (!preg_match("/^[0-9]{10}$/", $phone)) {
        $error = "Enter a valid 10-digit phone number.";
    }
    else {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>

    <link rel="stylesheet" href="style.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>

<div class="container">

    <h1>Student Registration Form</h1>
    <p>Enter your details to register.</p>

    <?php if ($success) { ?>

        <div class="result">
            <h2>Registration Successful!</h2>

            <h3>Student Details</h3>

            <p><b>Name:</b>
            <?php echo htmlspecialchars($name); ?></p>

            <p><b>Email:</b>
            <?php echo htmlspecialchars($email); ?></p>

            <p><b>Phone:</b>
            <?php echo htmlspecialchars($phone); ?></p>

            <p><b>Gender:</b>
            <?php echo htmlspecialchars($gender); ?></p>

            <p><b>Course:</b>
            <?php echo htmlspecialchars($course); ?></p>

            <p><b>Address:</b>
            <?php echo htmlspecialchars($address); ?></p>

            <button onclick="window.location.href='index.php'">
                Register Another Student
            </button>
        </div>

    <?php } else { ?>

        <?php if ($error != "") { ?>
            <p class="error">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php } ?>

        <form method="POST" id="regForm">

            <label>Full Name</label>
            <input type="text" name="name" required>

            <label>Email Address</label>
            <input type="email" name="email" required>

            <label>Phone Number</label>
            <input type="text" name="phone"
                   maxlength="10" required>

            <label>Gender</label>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label>Select Course</label>
            <select name="course" required>
                <option value="">Select Course</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Information Science">Information Science</option>
                <option value="Electronics">Electronics</option>
                <option value="Mechanical">Mechanical</option>
            </select>

            <label>Address</label>
            <textarea name="address" required></textarea>

            <button type="submit">Submit Registration</button>

        </form>

    <?php } ?>

</div>

<script>
$(document).ready(function() {

    $("#regForm").submit(function(event) {

        var phone = $("input[name='phone']").val();

        if (!/^[0-9]{10}$/.test(phone)) {
            alert("Please enter a valid 10-digit phone number.");
            event.preventDefault();
        }

    });

});
</script>

</body>
</html>
