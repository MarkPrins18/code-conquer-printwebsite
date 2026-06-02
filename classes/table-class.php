<?php 

class Table 
{
    private array $data = [];
    private int $extraColumns = 0;

    

    public function setData(array $data, int $extraColumns = 0): void
    {
        $this->data = $data;
        $this->extraColumns = $extraColumns;
    }

    public function renderTable(): string {
        
        if (empty($this->data)) {
            return '<p>No data available.</p>'; //change error
        } 
        // headers
        $html = '<table>';
        $html .= '<thead><tr>';
        foreach (array_keys($this->data[0]) as $header) {
            $html .= '<th>' . htmlspecialchars($header) . '</th>';
        }

        //extra header
        for ($i = 0; $i < $this->extraColumns; $i++) {
            $html .= '<th></th>';
        }
        $html .= '</tr></thead>';

        //rows
        $html .= '<tbody>';

        $rowIndex = 0;
        foreach ($this->data as $row) {
            $html .= '<tr>';
            foreach ($row as $value) {
                $html .= '<td>' . htmlspecialchars($value) . '</td>';
            }

            // Extra lege TD's
            for ($i = 1; $i <= $this->extraColumns; $i++) {
                $id = $this->extraColumns === 1
                    ? "td-row-{$rowIndex}"
                    : "td-row-{$rowIndex}-{$i}";
                $html .= '<td id="' . $id . '"></td>';
            }

            $html .= '</tr>';
            $rowIndex++;
        }
        $html .= '</tbody></table>';
        return $html;
    }
}
