<?php

class Table
{
    private array $data = [];
    private array $customColumns = [];
    private array $columnLabels = [];
    private array $columnRenderers = [];

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function renderTable(): string {

        if (empty($this->data)) {
            return '<p>No data available.</p>';
        }
        // headers
        $html = '<table>';
        $html .= '<thead><tr>';

        foreach (array_keys($this->data[0]) as $key) {
        $label = $this->columnLabels[$key] ?? $key;
        $html .= '<th>' . htmlspecialchars($label) . '</th>';
        }

        foreach ($this->customColumns as $column) {
        $html .= '<th>' . htmlspecialchars($column['label']) . '</th>';
        }

        $html .= '</tr></thead>';

        //rows
        $html .= '<tbody>';

        $rowIndex = 0;
        foreach ($this->data as $row) {
            $html .= '<tr>';
            foreach ($row as $key => $value) {
                if (isset($this->columnRenderers[$key])) {
                    $html .= '<td>' . ($this->columnRenderers[$key])($value, $row) . '</td>';
                } else {
                    $html .= '<td>' . htmlspecialchars($value ?? '') . '</td>';
                }
            }

            // custom columns
           foreach ($this->customColumns as $column) {
            $html .= '<td>' . $column['callback']($row) . '</td>';
            }

            $html .= '</tr>';
            $rowIndex++;
        }
        $html .= '</tbody></table>';
        return $html;
    }

    public function setColumnRenderer(string $key, callable $callback): void
    {
        $this->columnRenderers[$key] = $callback;
    }

    public function addCustomColumn(string $label, callable $callback): void
    {
        $this->customColumns[] = [
            'label' => $label,
            'callback' => $callback
        ];
    }

    public function autoColumnLabels(): void
    {
        if (empty($this->data)) {
            return;
        }

        global $tableTranslations;
        global $lang;
        $labels = [];

        foreach (array_keys($this->data[0]) as $key) {
        $labels[$key] = translate($key, $tableTranslations, $lang);
        }

        foreach ($this->customColumns as &$column) {
        $column['label'] = translate($column['label'], $tableTranslations, $lang);
        }

        $this->columnLabels = $labels;
    }
}