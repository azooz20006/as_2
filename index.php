<?php
$h = "";
$re = "";
$pas = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pas = $_POST["password"] ?? "";
    $h   = $_POST["stored_hash"] ?? "";

    if (isset($_POST["h"])) {
        $h = password_hash($pas, PASSWORD_DEFAULT);
    }

    if (isset($_POST["verify"])) {
        if ($h != "" && password_verify($pas, $h)) {
            $re = "صح";
        } else {
            $re = "خطأ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Password Hashing</title>
</head>
<body>

<h2>PHP Password Hashing</h2>

<form method="POST">
    <input type="password" name="password" placeholder="ادخل كلمة المرور" required>
    <input type="hidden" name="stored_hash" value="<?= htmlspecialchars($h) ?>">
    <br><br>
    <button type="submit" name="h">Hash Password</button>
    <button type="submit" name="verify">Verify Password</button>
</form>

<?php if ($pas != ""): ?>
    <p><strong>Password:</strong> <?= htmlspecialchars($pas) ?></p>
<?php endif; ?>

<?php if ($h != ""): ?>
    <p><strong>Hash:</strong> <?= htmlspecialchars($h) ?></p>
<?php endif; ?>

<?php if ($re != ""): ?>
    <p><strong>Result:</strong> <?= $re ?></p>
<?php endif; ?>

</body>
</html>
