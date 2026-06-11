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
        move_uploaded_file($file['tmp_name'], BASE_PATH . '/assets/images/products-images/' . $filename);
        return '/assets/images/products-images/' . $filename;
    }
}
