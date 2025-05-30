<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '../logs/php-error.log');

require_once __DIR__ . '/../config/database.php';

class AssetsController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Get all personnel records from both officer and enlistment tables
     */
    public function getPersonnel($filters = [])
    {
        try {
            $conditions = [];
            $params = [];

            // Apply filters (optional parameters)
            if (!empty($filters['entry_type'])) {
                $entryType = $filters['entry_type'];
                if ($entryType === 'Officer') {
                    $query = "SELECT id, first_name, middle_name, last_name, contact_number, 'Officer' AS entry_type
                          FROM officer_records";
                } elseif ($entryType === 'Enlistment') {
                    $query = "SELECT id, first_name, middle_name, last_name, contact_number, 'Enlistment' AS entry_type
                          FROM enlistment_records";
                } else {
                    throw new Exception("Invalid entry type.");
                }

                if (!empty($filters['rank'])) {
                    $conditions[] = "rank LIKE ?";
                    $params[] = "%" . $filters['rank'] . "%";
                }

                if (!empty($filters['gender'])) {
                    $conditions[] = "gender = ?";
                    $params[] = $filters['gender'];
                }

                if (!empty($filters['birthday_from']) && !empty($filters['birthday_to'])) {
                    $conditions[] = "birthday BETWEEN ? AND ?";
                    $params[] = $filters['birthday_from'];
                    $params[] = $filters['birthday_to'];
                }

                if ($conditions) {
                    $query .= " WHERE " . implode(" AND ", $conditions);
                }

                $query .= " ORDER BY last_name ASC";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute($params);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            } else {
                // No entry type — do UNION ALL on both
                $query = "
                SELECT id, first_name, middle_name, last_name, contact_number, 'Officer' AS entry_type 
                FROM officer_records
                UNION ALL
                SELECT id, first_name, middle_name, last_name, contact_number, 'Enlistment' AS entry_type 
                FROM enlistment_records
                ORDER BY last_name ASC
            ";
                $stmt = $this->pdo->query($query);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

        } catch (PDOException $e) {
            error_log("Database error (getPersonnel): " . $e->getMessage());
            return [];
        }
    }

}
