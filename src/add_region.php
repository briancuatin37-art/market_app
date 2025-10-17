<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = trim($_POST['name']);
    $abbrev = trim($_POST['abbrev']);
    $code   = trim($_POST['code']);
    $country_id = $_POST['country_id'];

    if (empty($name) || empty($abbrev) || empty($code) || empty($country_id)) {
        echo "❌ Todos los campos son obligatorios.";
        exit;
    }

    // Verificar que el país existe
    $check_country = pg_query_params($conn, "SELECT id FROM countries WHERE id = $1", array($country_id));
    if (pg_num_rows($check_country) == 0) {
        echo "⚠️ País no válido.";
        exit;
    }

    // Validar duplicado
    $check = pg_query_params($conn, "SELECT * FROM regions WHERE name = $1 AND country_id = $2", array($name, $country_id));
    if (pg_num_rows($check) > 0) {
        echo "⚠️ La región ya existe en este país.";
        exit;
    }

    // Insertar región
    $insert = pg_query_params($conn, "INSERT INTO regions (name, abbrev, code, country_id) VALUES ($1, $2, $3, $4)", array($name, $abbrev, $code, $country_id));

    if ($insert) {
        echo "✅ Región registrada correctamente.";
    } else {
        echo "❌ Error al insertar: " . pg_last_error($conn);
    }
}
?>
