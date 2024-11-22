<?php

namespace MyApp\Database;

require __DIR__ . "/../../vendor/autoload.php";

class Category extends QueryExecutor
{
    private int $id;
    private string $name;

    public static function read(): array
    {
        return parent::executeQuery("SELECT * FROM Categories", "Error reading categories")->fetchAll();
    }

    public function create(): void
    {
        parent::executeQuery("INSERT INTO Categories (name) VALUES (:n)", "Failed to create category {$this->name}", [
            ":n" => $this->name,
        ]);
    }

    public static function createDefaultCategories(): void
    {
        $categories = [
            "Bazar",
            "Limpieza",
            "Alimentos",
            "Bebidas",
            "Electrónica",
            "Ropa",
            "Calzado",
            "Hogar",
            "Juguetes",
            "Papelería",
            "Herramientas",
            "Jardinería",
            "Deportes",
            "Mascotas",
            "Salud y Belleza"
        ];
        foreach ($categories as $category) {
            (new Category)->setName($category)->create();
        }
    }

    public static function getCategoriesId(): array
    {
        $result = parent::executeQuery("SELECT id FROM Categories", "Failed to fetch category IDs");
        $ids = [];
        while ($row = $result->fetch()) {
            if (isset($row["id"])) $ids[] = $row["id"];
        }
        return $ids;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}