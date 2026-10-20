<?php
session_start();

$errors = [];
$data = [];
$success = false;

$fields = [
    "name" => "Student Name",
    "pob" => "Place of Birth",
    "dob" => "Date of Birth",
    "address" => "Address",
    "gender" => "Gender",
    "telephone" => "Telephone",
    "email" => "Email",
    "parent_name" => "Parent Name",
    "parent_telephone" => "Parent Telephone",
    "relationship" => "Relationship",
    "student_id" => "Student ID",
    "faculty" => "Faculty",
    "department" => "Department",
    "class" => "Class",
    "registration_date" => "Registration Date"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($fields as $key => $label) {
        $data[$key] = trim($_POST[$key] ?? "");

        if ($data[$key] === "") {
            $errors[$key] = "$label is required.";
        }
    }

    if ($data["name"] !== "" &&
        !preg_match("/^[a-zA-Z ]+$/", $data["name"])) {
        $errors["name"] = "Name must contain only letters and spaces.";
    }

    if ($data["email"] !== "" &&
        !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Enter a valid email address.";
    }

    if (!isset($_FILES["image"]) ||
        $_FILES["image"]["error"] === UPLOAD_ERR_NO_FILE) {
        $errors["image"] = "Please upload a student image.";
    } elseif ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        $errors["image"] = "Image upload failed.";
    } else {
        $file = $_FILES["image"];
        $extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
        $allowedTypes = ["image/jpeg", "image/png", "image/gif"];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file["tmp_name"]);

        if (!in_array($extension, $allowedExtensions, true) ||
            !in_array($mime, $allowedTypes, true)) {
            $errors["image"] = "Only JPG, JPEG, PNG and GIF images are allowed.";
        } elseif ($file["size"] > 2 * 1024 * 1024) {
            $errors["image"] = "Image must not exceed 2 MB.";
        }
    }

    if (empty($errors)) {
        $folder = __DIR__ . "/uploads/";

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $imageName = bin2hex(random_bytes(16)) . "." . $extension;

        if (move_uploaded_file($file["tmp_name"], $folder . $imageName)) {
            $data["image"] = "uploads/" . $imageName;
            $success = true;
        } else {
            $errors["image"] = "Unable to save the image.";
        }
    }
}

function showError($key, $errors) {
    if (isset($errors[$key])) {
        echo '<div class="error">' .
            htmlspecialchars($errors[$key]) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>
body {
    background: #e1e3da;
    font-family: Arial, sans-serif;
}
.container-box {
    max-width: 850px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px #0002;
}
h2 {
    background: #1769aa;
    color: white;
    padding: 20px;
    text-align: center;
    border-radius: 8px;
}
h4 {
    color: #1769aa;
    border-bottom: 2px solid #ddd;
    padding-bottom: 8px;
    margin-top: 25px;
}
.error {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}
.student-image {
    width: 130px;
    height: 130px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #1769aa;
}
</style>
</head>
<body>

<div class="container-box">

<?php if ($success): ?>

    <h2>Registration Successful</h2>

    <div class="text-center mb-4">
        <img src="<?= htmlspecialchars($data["image"]) ?>"
             class="student-image" alt="Student Image">
    </div>

    <table class="table table-bordered table-striped">
        <tr class="table-dark">
            <th>Information</th>
            <th>Details</th>
        </tr>

        <tr><th colspan="2">Personal Information</th></tr>
        <?php
        $personal = [
            "Student Name" => "name",
            "Place of Birth" => "pob",
            "Date of Birth" => "dob",
            "Address" => "address",
            "Gender" => "gender",
            "Telephone" => "telephone",
            "Email" => "email"
        ];
        foreach ($personal as $label => $key):
        ?>
        <tr>
            <td><?= htmlspecialchars($label) ?></td>
            <td><?= htmlspecialchars($data[$key]) ?></td>
        </tr>
        <?php endforeach; ?>

        <tr><th colspan="2">Parent Information</th></tr>
        <?php
        $parent = [
            "Parent Name" => "parent_name",
            "Parent Telephone" => "parent_telephone",
            "Relationship" => "relationship"
        ];
        foreach ($parent as $label => $key):
        ?>
        <tr>
            <td><?= htmlspecialchars($label) ?></td>
            <td><?= htmlspecialchars($data[$key]) ?></td>
        </tr>
        <?php endforeach; ?>

        <tr><th colspan="2">Academic Information</th></tr>
        <?php
        $academic = [
            "Student ID" => "student_id",
            "Faculty" => "faculty",
            "Department" => "department",
            "Class" => "class",
            "Registration Date" => "registration_date"
        ];
        foreach ($academic as $label => $key):
        ?>
        <tr>
            <td><?= htmlspecialchars($label) ?></td>
            <td><?= htmlspecialchars($data[$key]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="index.php" class="btn btn-primary">Register Another Student</a>

<?php else: ?>

    <h2>Student Registration Form</h2>

    <form method="POST" enctype="multipart/form-data" novalidate>

        <h4>Personal Information</h4>

        <label class="form-label">Student Name</label>
        <input class="form-control" type="text" name="name"
               value="<?= htmlspecialchars($data["name"] ?? "") ?>" autofocus>
        <?php showError("name", $errors); ?>

        <label class="form-label mt-3">Place of Birth</label>
        <input class="form-control" type="text" name="pob"
               value="<?= htmlspecialchars($data["pob"] ?? "") ?>">
        <?php showError("pob", $errors); ?>

        <label class="form-label mt-3">Date of Birth</label>
        <input class="form-control" type="date" name="dob"
               value="<?= htmlspecialchars($data["dob"] ?? "") ?>">
        <?php showError("dob", $errors); ?>

        <label class="form-label mt-3">Address</label>
        <input class="form-control" type="text" name="address"
               value="<?= htmlspecialchars($data["address"] ?? "") ?>">
        <?php showError("address", $errors); ?>

        <label class="form-label mt-3">Gender</label>
        <select class="form-select" name="gender">
            <option value="">Select Gender</option>
            <option value="Female" <?= ($data["gender"] ?? "") === "Female" ? "selected" : "" ?>>Female</option>
            <option value="Male" <?= ($data["gender"] ?? "") === "Male" ? "selected" : "" ?>>Male</option>
        </select>
        <?php showError("gender", $errors); ?>

        <label class="form-label mt-3">Telephone</label>
        <input class="form-control" type="tel" name="telephone"
               value="<?= htmlspecialchars($data["telephone"] ?? "") ?>">
        <?php showError("telephone", $errors); ?>

        <label class="form-label mt-3">Email</label>
        <input class="form-control" type="email" name="email"
               value="<?= htmlspecialchars($data["email"] ?? "") ?>">
        <?php showError("email", $errors); ?>

        <label class="form-label mt-3">Student Image</label>
        <input class="form-control" type="file" name="image"
               accept=".jpg,.jpeg,.png,.gif">
        <?php showError("image", $errors); ?>
        <small class="text-muted">JPG, PNG or GIF, maximum 2 MB.</small>

        <h4>Parent Information</h4>

        <label class="form-label">Parent Name</label>
        <input class="form-control" type="text" name="parent_name"
               value="<?= htmlspecialchars($data["parent_name"] ?? "") ?>">
        <?php showError("parent_name", $errors); ?>

        <label class="form-label mt-3">Parent Telephone</label>
        <input class="form-control" type="tel" name="parent_telephone"
               value="<?= htmlspecialchars($data["parent_telephone"] ?? "") ?>">
        <?php showError("parent_telephone", $errors); ?>

        <label class="form-label mt-3">Relationship</label>
        <select class="form-select" name="relationship">
            <option value="">Select Relationship</option>
            <option value="Father" <?= ($data["relationship"] ?? "") === "Father" ? "selected" : "" ?>>Father</option>
            <option value="Mother" <?= ($data["relationship"] ?? "") === "Mother" ? "selected" : "" ?>>Mother</option>
            <option value="Guardian" <?= ($data["relationship"] ?? "") === "Guardian" ? "selected" : "" ?>>Guardian</option>
        </select>
        <?php showError("relationship", $errors); ?>

        <h4>Academic Information</h4>

        <label class="form-label">Student ID</label>
        <input class="form-control" type="text" name="student_id"
               value="<?= htmlspecialchars($data["student_id"] ?? "") ?>">
        <?php showError("student_id", $errors); ?>

        <label class="form-label mt-3">Faculty</label>
        <input class="form-control" type="text" name="faculty"
               value="<?= htmlspecialchars($data["faculty"] ?? "") ?>">
        <?php showError("faculty", $errors); ?>

        <label class="form-label mt-3">Department</label>
        <input class="form-control" type="text" name="department"
               value="<?= htmlspecialchars($data["department"] ?? "") ?>">
        <?php showError("department", $errors); ?>

        <label class="form-label mt-3">Class</label>
        <input class="form-control" type="text" name="class"
               value="<?= htmlspecialchars($data["class"] ?? "") ?>">
        <?php showError("class", $errors); ?>

        <label class="form-label mt-3">Registration Date</label>
        <input class="form-control" type="date" name="registration_date"
               value="<?= htmlspecialchars($data["registration_date"] ?? "") ?>">
        <?php showError("registration_date", $errors); ?>

        <button class="btn btn-primary w-100 mt-4" type="submit">
            Register Student
        </button>
    </form>

    <?php if (!empty($errors)): ?>
    <script>
        document.querySelector('[name="<?= htmlspecialchars(array_key_first($errors), ENT_QUOTES) ?>"]')?.focus();
    </script>
    <?php endif; ?>

<?php endif; ?>

</div>
</body>
</html>
