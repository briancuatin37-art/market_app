<?php
include('../config/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = trim($_POST['name']);
    $abbrev = trim($_POST['abbrev']);
    $code   = trim($_POST['code']);

    if (empty($name) || empty($abbrev) || empty($code)) {
        echo "❌ Todos los campos son obligatorios.";
        exit;
    }

    // Validar duplicado
    $check = pg_query_params($conn, "SELECT * FROM countries WHERE name = $1 OR code = $2", array($name, $code));
    if (pg_num_rows($check) > 0) {
        echo "⚠️ El país ya existe.";
        exit;
    }

    // Insertar registro
    $insert = pg_query_params($conn, "INSERT INTO countries (name, abbrev, code) VALUES ($1, $2, $3)", array($name, $abbrev, $code));

    if ($insert) {
        echo "✅ País registrado correctamente.";
    } else {
        echo "❌ Error al insertar: " . pg_last_error($conn);
    }
}
?>
