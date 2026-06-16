<?php

class AdminProductController {
    public function index(): void {
        AuthGuard::requireAdmin();

        $pdo      = Database::getConnection();
        $model    = new Product($pdo);
        $products = $model->getAll();

        view('admin/products/index', ['products' => $products]);
    }

    public function create(): void {
        AuthGuard::requireAdmin();
        view('admin/products/create', ['errors' => [], 'old' => []]);
    }

    public function store(): void {
        AuthGuard::requireAdmin();

        $name          = trim($_POST['name'] ?? '');
        $price         = $_POST['price'] ?? '';
        $description   = trim($_POST['description'] ?? '');
        $sku           = trim($_POST['sku'] ?? '');
        $stockQuantity = $_POST['stock_quantity'] ?? '';

        $errors = [];
        if ($name === '') {
            $errors['name'] = 'Naam is verplicht.';
        }
        if (!is_numeric($price) || (float) $price < 0) {
            $errors['price'] = 'Prijs moet een positief getal zijn.';
        }
        if ($description === '') {
            $errors['description'] = 'Omschrijving is verplicht.';
        }
        if ($sku === '') {
            $errors['sku'] = 'SKU is verplicht.';
        }
        if (!ctype_digit($stockQuantity) || (int) $stockQuantity < 0) {
            $errors['stock_quantity'] = 'Voorraad moet een geheel getal zijn.';
        }

        $imgUrl = $this->handleImageUpload($_FILES['img_url'] ?? null, $errors);

        if (!empty($errors)) {
            view('admin/products/create', [
                'errors' => $errors,
                'old'    => $_POST,
            ]);
            return;
        }

        $pdo   = Database::getConnection();
        $model = new Product($pdo);
        $model->create($name, (float) $price, $description, $imgUrl, $sku, (int) $stockQuantity);

        Session::flash('success', 'Product "' . $name . '" succesvol toegevoegd.');
        header('Location: ' . BASE_URL . '/admin/products');
        exit;
    }

    public function showCsvUpload(): void {
        AuthGuard::requireAdmin();
        view('admin/products/import', ['error' => null, 'saved' => null, 'rowErrors' => []]);
    }

    public function handleCsvUpload(): void {
        AuthGuard::requireAdmin();

        $file = $_FILES['csv_file'] ?? null;

        if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
            view('admin/products/import', ['error' => 'Selecteer een CSV bestand.', 'saved' => null, 'rowErrors' => []]);
            return;
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            view('admin/products/import', ['error' => 'Uploadfout, probeer opnieuw.', 'saved' => null, 'rowErrors' => []]);
            return;
        }
        if (strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)) !== 'csv') {
            view('admin/products/import', ['error' => 'Alleen .csv bestanden zijn toegestaan.', 'saved' => null, 'rowErrors' => []]);
            return;
        }
        if ($file['size'] > 10 * 1024 * 1024) {
            view('admin/products/import', ['error' => 'Bestand mag maximaal 10 MB zijn.', 'saved' => null, 'rowErrors' => []]);
            return;
        }

        $handle   = fopen($file['tmp_name'], 'r');
        $header   = fgetcsv($handle);
        $expected = ['name', 'price', 'description', 'img_url', 'sku', 'stock_quantity'];

        if ($header !== $expected) {
            fclose($handle);
            view('admin/products/import', ['error' => 'Ongeldige kolomvolgorde. Verwacht: ' . implode(', ', $expected), 'saved' => null, 'rowErrors' => []]);
            return;
        }

        $pdo   = Database::getConnection();
        $model = new Product($pdo);

        $saved     = 0;
        $rowErrors = [];
        $lineNum   = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $lineNum++;

            if (count($row) !== 6) {
                $rowErrors[] = "Rij $lineNum: verkeerd aantal kolommen.";
                continue;
            }

            [$name, $price, $description, $imgUrl, $sku, $stockQuantity] = $row;
            $name          = trim($name);
            $price         = trim($price);
            $description   = trim($description);
            $imgUrl        = trim($imgUrl);
            $sku           = trim($sku);
            $stockQuantity = trim($stockQuantity);

            $errors = [];
            if ($name === '')                                                $errors[] = 'naam is verplicht';
            if (!is_numeric($price) || (float) $price < 0)                 $errors[] = 'prijs is ongeldig';
            if ($description === '')                                         $errors[] = 'omschrijving is verplicht';
            if ($sku === '')                                                 $errors[] = 'SKU is verplicht';
            if (!ctype_digit($stockQuantity) || (int) $stockQuantity < 0)  $errors[] = 'voorraad is ongeldig';

            if (!empty($errors)) {
                $rowErrors[] = "Rij $lineNum ($name): " . implode(', ', $errors) . '.';
                continue;
            }

            try {
                $model->upsertByName($name, (float) $price, $description, $imgUrl, $sku, (int) $stockQuantity);
                $saved++;
            } catch (Exception $e) {
                $rowErrors[] = "Rij $lineNum ($name): kon niet worden opgeslagen.";
            }
        }

        fclose($handle);

        view('admin/products/import', ['error' => null, 'saved' => $saved, 'rowErrors' => $rowErrors]);
    }

    private function handleImageUpload(?array $file, array &$errors): string
    {
        if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return '';
        }
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors['img_url'] = 'Uploadfout, probeer opnieuw.';
            return '';
        }

        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $mime    = mime_content_type($file['tmp_name']);
        if (!in_array($mime, $allowed, true)) {
            $errors['img_url'] = 'Alleen JPG, PNG, WEBP of GIF is toegestaan.';
            return '';
        }
        if ($file['size'] > 5 * 1024 * 1024) {
            $errors['img_url'] = 'Afbeelding mag maximaal 5 MB zijn.';
            return '';
        }

        $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = uniqid('product_', true) . '.' . $ext;
        $dest     = BASE_PATH . '/assets/images/products-images/' . $filename;
        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            $errors['img_url'] = 'Afbeelding kon niet worden opgeslagen, probeer opnieuw.';
            return '';
        }
        return '/assets/images/products-images/' . $filename;
    }
}
