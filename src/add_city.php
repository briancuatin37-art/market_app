<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = trim($_POST['name']);
    $abbrev = trim($_POST['abbrev']);
    $code   = trim($_POST['code']);
    $region_id = $_POST['region_id'];

    if (empty($name) || empty($abbrev) || empty($code) || empty($region_id)) {
        echo "❌ Todos los campos son obligatorios.";
        exit;
    }

    // Validar región existente
    $check_region = pg_query_params($conn, "SELECT id FROM regions WHERE id = $1", array($region_id));
    if (pg_num_rows($check_region) == 0) {
        echo "⚠️ Región no válida.";
        exit;
    }

    // Evitar duplicados
    $check = pg_query_params($conn, "SELECT * FROM cities WHERE name = $1 AND region_id = $2", array($name, $region_id));
    if (pg_num_rows($check) > 0) {
        echo "⚠️ La ciudad ya existe en esa región.";
        exit;
    }

    // Insertar ciudad
    $insert = pg_query_params($conn, "INSERT INTO cities (name, abbrev, code, region_id) VALUES ($1, $2, $3, $4)", array($name, $abbrev, $code, $region_id));

    if ($insert) {
        echo "✅ Ciudad registrada correctamente.";
    } else {
        echo "❌ Error al insertar: " . pg_last_error($conn);
    }
}
?>
