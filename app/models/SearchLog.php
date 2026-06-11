<?php

class SearchLog {
    public function __construct(private PDO $pdo) {}

    public function logIfInvalid(string $searchTerm, array $results): void {
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
    

    private function save(string $term): void {
        try {
            $sql = "INSERT INTO failed_search_results (search_string, updated_at) VALUES (:term, NOW())";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['term' => $term]);
            
        } catch (PDOException $e) {
            error_log("Failed to log search: " . $e->getMessage());
        }
    }
}
