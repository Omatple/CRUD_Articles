<?php

namespace MyApp\Database;

use MyApp\Database\Connection;
use \Exception;
use \PDOException;
use \PDOStatement;

require __DIR__ . "/../../vendor/autoload.php";

class QueryExecutor
{
    protected static function executeQuery(string $query, ?string $customErrorMessage = null, ?array $parameters = null): PDOStatement
    {
        $connection = Connection::getInstance();
        $pdo = $connection->getConnection();
        if ($pdo === null) throw new Exception("Database connection is not available.");
        $stmt = $pdo->prepare($query);
        try {
            $parameters ? $stmt->execute($parameters) : $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            $errorMessage = $customErrorMessage ?? 'Error executing query';
            throw new Exception("{$errorMessage}: {$e->getMessage()}", (int) $e->getCode());
        }
    }
}
