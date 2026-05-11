<?php

/**
 * Script para reparar directorios de storage y permisos en Laravel.
 */

$basePath = __DIR__ . '/../storage';
$directories = [
    $basePath . '/framework/sessions',
    $basePath . '/framework/views',
    $basePath . '/framework/cache',
    $basePath . '/framework/cache/data',
    $basePath . '/app/public',
];

echo '<style>
    body { font-family: sans-serif; background: #f0f2f5; padding: 20px; }
    .log { background: #1e1e1e; color: #d4d4d4; padding: 15px; border-radius: 5px; font-family: monospace; line-height: 1.5; }
    .success { color: #4ec9b0; }
    .error { color: #f44747; }
    .info { color: #9cdcfe; }
</style>';

echo '<h1>Reparador de Storage Laravel</h1>';
echo '<div class="log">';

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        if (mkdir($dir, 0775, true)) {
            echo "<p class='success'>[CREADO] $dir</p>";
        } else {
            echo "<p class='error'>[ERROR] No se pudo crear: $dir</p>";
        }
    } else {
        echo "<p class='info'>[EXISTE] $dir</p>";
    }

    // Intentar asegurar permisos
    if (chmod($dir, 0775)) {
        echo "<p class='success'>[PERMISOS] 0775 aplicado a $dir</p>";
    } else {
        echo "<p class='error'>[ERROR] No se pudo aplicar chmod a $dir</p>";
    }
}

// Limpiar caché si es posible
echo "<p class='info'>--- Intentando optimizar ---</p>";
try {
    $artisan = __DIR__ . '/../artisan';
    if (file_exists($artisan)) {
        echo "<p class='info'>Ejecutando clear-compiled...</p>";
        shell_exec("php $artisan clear-compiled");
        echo "<p class='success'>Clear-compiled ejecutado.</p>";
    }
} catch (Exception $e) {
    echo "<p class='error'>No se pudo ejecutar artisan: " . $e->getMessage() . "</p>";
}

echo '</div>';
echo '<p><b>Importante:</b> Si sigues teniendo errores, verifica que el usuario que corre el servidor web (www-data, apache, etc.) sea el dueño de la carpeta storage.</p>';
