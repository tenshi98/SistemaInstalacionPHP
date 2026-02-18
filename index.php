<?php

/*
* Punto de Entrada del Instalador
*
* Este archivo maneja el enrutamiento básico entre las diferentes páginas del asistente.
*/

// Iniciar sesión
session_start();

// Configurar zona horaria
date_default_timezone_set('America/Santiago');

// Cargar configuración
$config = require __DIR__ . '/config/settings.php';

// Cargar clases core
require_once __DIR__ . '/core/Logger.php';
require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/MySQLDatabase.php';
require_once __DIR__ . '/core/Validator.php';
require_once __DIR__ . '/core/ConfigManager.php';

// Inicializar logger
$logger = new Logger($config);

// Determinar la página actual
$page = $_GET['page'] ?? 'welcome';

// Páginas válidas
$validPages = ['welcome', 'credentials', 'database', 'summary', 'finish'];

// Validar página
if (!in_array($page, $validPages)) {
    $page = 'welcome';
}

// Incluir la página correspondiente
$pageFile = __DIR__ . '/pages/' . $page . '.php';

if (file_exists($pageFile)) {
    include $pageFile;
} else {
    // Si no existe la página, redirigir a welcome
    header('Location: index.php?page=welcome');
    exit;
}
