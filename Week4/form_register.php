<?php

$errMsg = [];
$success = false;

$fullname = "";
$email = "";
$pob = "";
$gender = "";
$faculty = "";
$languages = [];
$comment = "";

if (isset($_GET["submit"])) {

    $fullname = trim($_GET["fullname"] ?? "");
    $email = trim($_GET["email"] ?? "");
    $pob = trim($_GET["pob"] ?? "");
    $gender = $_GET["gender"] ?? "";
    $faculty = $_GET["faculty"] ?? "";
    $languages = $_GET["languages"] ?? [];
    $comment = trim($_GET["comment"] ?? "");

    // Fullname validation
    if (empty($fullname)) {
        $errMsg[] = "Fullname is required.";
    }

    // Email validation
    if (empty($email)) {
        $errMsg[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errMsg[] = "Please enter a valid email address.";
    }

    // Place of Birth validation
    if (empty($pob)) {
        $errMsg[] = "Place of Birth is required.";
    }

    // Gender validation
    if (!in_array($gender, ["male", "female"])) {
        $errMsg[] = "Please select your gender.";
    }

    // Faculty validation
    if (!in_array($faculty, ["computer", "medicine", "engineering", "ecom"])) {
        $errMsg[] = "Please select a valid faculty.";
    }

    // Languages validation
    if (!is_array($languages)) {
        $languages = [];
    }

    $allowedLanguages = ["Somali", "English", "Arabic", "Chinese"];

    foreach ($languages as $language) {
        if (!in_array($language, $allowedLanguages)) {
            $errMsg[] = "Invalid language selected.";
            $languages = [];
            break;
        }
    }

    // Display results if there are no errors
    if (empty($errMsg)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Registration</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h2 class="mb-0">Student Registration Form</h2>
                </div>

                <div class="card-body p-4">

                    <?php if (!empty($errMsg)): ?>
                        <div class="alert alert-danger">
                            <strong>Please correct the following errors:</strong>
                            <ul class="mb-0">
                                <?php foreach ($errMsg as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if ($success): ?>
                        <div class="alert alert-success">
                            <h4>Student Information</h4>

                            <p><strong>Fullname:</strong>
                                <?= htmlspecialchars($fullname) ?></p>

                            <p><strong>Email:</strong>
                                <?= htmlspecialchars($email) ?></p>

                            <p><strong>Place of Birth:</strong>
                                <?= htmlspecialchars($pob) ?></p>

                            <p><strong>Gender:</strong>
                                <?= htmlspecialchars(ucfirst($gender)) ?></p>

                            <p><strong>Faculty:</strong>
                                <?php
                                $faculties = [
                                    "computer" => "Computer and IT",
                                    "medicine" => "Medicine and Health Science",
                                    "engineering" => "Engineering",
                                    "ecom" => "Business"
                                ];

                                echo htmlspecialchars($faculties[$faculty]);
                                ?>
                            </p>

                            <p><strong>Languages:</strong>
                                <?= htmlspecialchars(implode(", ", $languages)) ?>
                            </p>

                            <p><strong>Comment:</strong>
                                <?= nl2br(htmlspecialchars($comment)) ?></p>
                        </div>
                    <?php endif; ?>

                    <form method="get" action="">

                        <fieldset class="border rounded p-3">

                            <legend class="float-none w-auto px-2">
                                Personal Information
                            </legend>

                            <div class="mb-3">
                                <label class="form-label">Fullname *</label>
                                <input type="text"
                                       name="fullname"
                                       class="form-control"
                                       placeholder="Enter your fullname"
                                       value="<?= htmlspecialchars($fullname) ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="example@email.com"
                                       value="<?= htmlspecialchars($email) ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Place of Birth *</label>
                                <input type="text"
                                       name="pob"
                                       class="form-control"
                                       placeholder="Enter your birthplace"
                                       value="<?= htmlspecialchars($pob) ?>"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Gender *</label>

                                <div class="form-check form-check-inline">
                                    <input type="radio"
                                           name="gender"
                                           value="male"
                                           class="form-check-input"
                                           <?= $gender === "male" ? "checked" : "" ?>
                                           required>
                                    <label class="form-check-label">Male</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input type="radio"
                                           name="gender"
                                           value="female"
                                           class="form-check-input"
                                           <?= $gender === "female" ? "checked" : "" ?>>
                                    <label class="form-check-label">Female</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Faculty *</label>

                                <select name="faculty" class="form-select" required>
                                    <option value="">Select Faculty</option>

                                    <option value="computer"
                                        <?= $faculty === "computer" ? "selected" : "" ?>>
                                        Computer and IT
                                    </option>

                                    <option value="medicine"
                                        <?= $faculty === "medicine" ? "selected" : "" ?>>
                                        Medicine and Health Science
                                    </option>

                                    <option value="engineering"
                                        <?= $faculty === "engineering" ? "selected" : "" ?>>
                                        Engineering
                                    </option>

                                    <option value="ecom"
                                        <?= $faculty === "ecom" ? "selected" : "" ?>>
                                        Business
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Languages</label>

                                <?php
                                $allLanguages = [
                                    "Somali", "English", "Arabic", "Chinese"
                                ];

                                foreach ($allLanguages as $language):
                                ?>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox"
                                               name="languages[]"
                                               value="<?= $language ?>"
                                               class="form-check-input"
                                               <?= in_array($language, $languages) ? "checked" : "" ?>>

                                        <label class="form-check-label">
                                            <?= $language ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Comment</label>
                                <textarea name="comment"
                                          class="form-control"
                                          rows="4"
                                          placeholder="Write your comment"><?= htmlspecialchars($comment) ?></textarea>
                            </div>

                            <div class="d-grid gap-2 d-sm-flex">
                                <button type="submit"
                                        name="submit"
                                        value="Register"
                                        class="btn btn-primary">
                                    Register
                                </button>

                                <button type="reset"
                                        class="btn btn-secondary">
                                    Clear
                                </button>
                            </div>

                            <p class="text-muted mt-3 mb-0">
                                * Required fields
                            </p>

                        </fieldset>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>