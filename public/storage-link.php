<?php

/**
 * Script para crear el acceso directo (symlink) de la carpeta storage en Laravel.
 * Útil para servidores donde no se tiene acceso SSH.
 */

$targetFolder = __DIR__ . '/../storage/app/public';
$linkFolder = __DIR__ . '/storage';

// Estilos básicos para la respuesta
echo '
<style>
    body { font-family: sans-serif; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; background: #f4f7f6; }
    .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; max-width: 500px; }
    .success { color: #2ecc71; font-weight: bold; }
    .error { color: #e74c3c; font-weight: bold; }
    .info { color: #3498db; }
    code { background: #eee; padding: 2px 4px; border-radius: 4px; }
</style>
<div class="card">';

if (file_exists($linkFolder)) {
    if (is_link($linkFolder)) {
        echo '<h1>Status</h1><p class="info">El enlace simbólico ya existe en <code>public/storage</code>.</p>';
    } else {
        echo '<h1>Error</h1><p class="error">Ya existe una carpeta llamada <code>storage</code> en <code>public/</code>. <br>Debes borrarla o renombrarla primero para crear el enlace simbólico.</p>';
    }
} else {
    try {
        if (symlink($targetFolder, $linkFolder)) {
            echo '<h1>Éxito</h1><p class="success">El enlace simbólico se ha creado correctamente.</p>';
            echo '<p>Ahora puedes acceder a tus archivos públicos mediante la URL base.</p>';
        } else {
            echo '<h1>Error</h1><p class="error">No se pudo crear el enlace simbólico.</p>';
            echo '<p>Es posible que la función <code>symlink()</code> esté deshabilitada en tu servidor.</p>';
        }
    } catch (Exception $e) {
        echo '<h1>Excepción</h1><p class="error">Error: ' . $e->getMessage() . '</p>';
    }
}

echo '</div>';
