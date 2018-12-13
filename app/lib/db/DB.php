<?php

namespace app\lib\db;

use PDO;

/**
 * Обёртка длля PDO.
 * @package app\lib\db
 */
class DB
{
    private $pdo;

    /**
     * DB constructor.
     */
    public function __construct()
    {
        $host    = config('dbHost');
        $db      = config('dbName');
        $user    = config('dbUser');
        $pass    = config('dbPassword');
        $charset = config('dbCharset');

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }


    /**
     * Получаем строки из БД.
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function row(string $sql, array $params = []): array
    {
        $query = $this->query($sql, $params);
        return $query->fetchAll();
    }


    /**
     * Получаем колонку из БД.
     * @param string $sql
     * @param array $params
     * @return string
     */
    public function col(string $sql, array $params = []): string
    {
        $query = $this->query($sql, $params);
        return $query->fetchColumn();
    }


    /**
     * Подготовленный запрос к БД.
     * @param string $sql
     * @param array $params
     * @return \PDOStatement
     */
    public function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }

        $stmt->execute();

        return $stmt;
    }


    /**
     * Стартуем транзакцию.
     */
    public function beginTransaction(): void
    {
        $this->pdo->beginTransaction();
    }


    /**
     * Коммитим транзакцию.
     */
    public function commit(): void
    {
        $this->pdo->commit();
    }


    /**
     * Откатываем транзакцию.
     */
    public function rollBack()
    {
        $this->pdo->rollBack();
    }
}