<?php

class SearchLog
{
    public function __construct(private PDO $pdo) {}

    public function getAll(string $searchTerm = ''): array
    {
        $sql = "SELECT failed_search_logs.log_id, failed_search_logs.search_string, failed_search_logs.updated_at
                FROM failed_search_logs";

        $params = [];
        if ($searchTerm !== '') {
            $sql .= " WHERE failed_search_logs.search_string LIKE :term";
            $params = ['term' => '%' . $searchTerm . '%'];
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }


    public function logIfInvalid(string $searchTerm, array $results): void
    {
        $searchTerm = trim($searchTerm);

        if ($this->isValidToLog($searchTerm, $results)) {
            $this->save($searchTerm);
        }
    }


    private function isValidToLog(string $term, array $results): bool
    {
        if (!empty($term) && empty($results) && strlen($term) >= 3 && !preg_match('/(.)\1{3,}/', $term)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function save(string $searchTerm): void
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO failed_search_logs (search_string, updated_at) VALUES (:term, NOW())");
            $success = $stmt->execute(['term' => $searchTerm]);

            if ($success) {
                error_log("SUCCESS: Saved '$searchTerm' to the database.");
            } else {
                error_log("FAILURE: Could not save '$searchTerm' to database.");
            }
        } catch (Exception $e) {
            error_log("DATABASE ERROR: " . $e->getMessage());
        }
    }


    public function delete(array $ids): bool
    {
        if (empty($ids)) return false;

        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM failed_search_logs WHERE log_id IN ($placeholders)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($ids);
    }
}



