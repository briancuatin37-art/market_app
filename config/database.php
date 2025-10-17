<?php
// database connection to Supabase
$supa_host     = "aws-1-us-east-1.pooler.supabase.com"; 
$supa_user     = "postgres.itmyczvttxhyxbdchjpv";
$supa_password = "unicesmag@@";
$supa_dbname   = "postgres";
$supa_port     = "6543";

// local database connection
$local_host     = "localhost";
$local_user     = "postgres";
$local_password = "unicesmag";
$local_dbname   = "marketapp";
$local_port     = "5432"; 

// connection strings
$supa_data_connection = "
host=$supa_host
user=$supa_user
password=$supa_password
dbname=$supa_dbname
port=$supa_port
";

$local_data_connection = "
host=$local_host
user=$local_user
password=$local_password
dbname=$local_dbname
port=$local_port
";

// conecta a la base de datos local o supabase
$conn = pg_connect($local_data_connection);

if (!$conn) {
    die("❌ Error de conexión: " . pg_last_error());
} else {
    // echo "✅ Conectado correctamente.";
}
?>
