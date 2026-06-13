<?php

class SearchLog
{
    public function __construct(private PDO $pdo) {}

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
}
