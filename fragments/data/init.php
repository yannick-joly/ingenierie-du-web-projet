<?php

/**
 * Script d'initialisation de la base de données SQLite
 */

$dbPath = __DIR__ . '/battleship.db';
$sqlPath = __DIR__ . '/init.sql';

try {
    // si la db existe déjà, on la supprime pour la remplacer
    if (file_exists($dbPath)) {
        unlink($dbPath);
    }

    $pdo = new PDO("sqlite:{$dbPath}");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = file_get_contents($sqlPath);
    $pdo->exec($sql);

    echo "Base de données créée : {$dbPath}\n";
} catch (PDOException $e) {
    die("Erreur lors de l'initialisation : " . $e->getMessage() . "\n");
}
