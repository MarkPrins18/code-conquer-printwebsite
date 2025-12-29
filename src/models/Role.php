<?php

class Role
{
    private int $id;
    private string $name;

    private static int $counter = 3; 
    private static array $roles = [];

    private function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    private static function initializeDefaults(): void
    {
        if (empty(self::$roles)) {
            self::$roles[] = new self(1, 'admin');
            self::$roles[] = new self(2, 'customer');
        }
    }

    public static function create(array $data): self
    {
        $role = new self(self::$counter++, $data['name'] ?? '');
        self::$roles[] = $role;
        return $role;
    }

    public static function getAll(): array
    {
        self::initializeDefaults();
        return self::$roles;
    }

    public static function findById(int $id): ?self
    {
        self::initializeDefaults();
        foreach (self::$roles as $role) {
            if ($role->id === $id) {
                return $role;
            }
        }
        return null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}