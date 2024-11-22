<?php

namespace MyApp\Database;

use \Faker\Factory;

require __DIR__ . "/../../vendor/autoload.php";

class Article extends QueryExecutor
{
    private int $id;
    private string $name;
    private string $description;
    private string $availability;
    private int $category_id;

    public function create(): void
    {
        parent::executeQuery(
            "INSERT INTO Articles (name, description, availability, category_id) VALUES (:n, :d, :a, :ci)",
            "Failed to create article '{$this->name}'. Ensure all fields are valid and the database is accessible.",
            [
                ":n" => $this->name,
                ":d" => $this->description,
                ":a" => $this->availability,
                ":ci" => $this->category_id
            ]
        );
    }

    public static function read(): array
    {
        return parent::executeQuery(
            "SELECT Articles.*, Categories.name as nameCat FROM Articles, Categories WHERE category_id = Categories.id ORDER BY nameCat",
            "Failed to retrieve articles and their associated categories. Verify database connection and query accuracy."
        )->fetchAll();
    }

    public static function delete(int $id): void
    {
        parent::executeQuery(
            "DELETE FROM Articles WHERE id = :i",
            "Failed to delete the article. Please verify the article ID and database connection.",
            [":i" => $id]
        );
    }

    public function update(int $id): void
    {
        parent::executeQuery(
            "UPDATE Articles SET name = :n, description = :d, availability = :a, category_id = :c WHERE id = :i",
            "Failed to update the article. Please verify the article ID and database connection.",
            [
                ":i" => $id,
                ":n" => $this->name,
                ":d" => $this->description,
                ":a" => $this->availability,
                ":c" => $this->category_id,
            ]
        );
    }

    public static function updateAvailability(int $id, string $availability): void
    {
        parent::executeQuery(
            "UPDATE Articles SET availability = :a WHERE id = :i",
            "Failed to update the article availability. Please verify the article ID and database connection.",
            [
                ":i" => $id,
                ":a" => $availability,
            ]
        );
    }

    public static function isNameTaken(string $name, ?int $id = null): bool
    {
        return QueryExecutor::executeQuery(
            ($id) ? "SELECT COUNT(*) FROM Articles WHERE name = :n AND id<>:i" : "SELECT COUNT(*) FROM Articles WHERE name = :n",
            "Failed to check if the article name '$name' is already in use. Please review the database query.",
            ($id) ? [":n" => $name, ":i" => $id] : [":n" => $name]
        )->fetchColumn();
    }

    public static function getArticleById(int $id): array|false
    {
        return parent::executeQuery(
            "SELECT * FROM Articles WHERE id = :i",
            "Failed to retrieve article. Verify database connection and query accuracy.",
            [":i" => $id]
        )->fetch();
    }

    public static function generateFakeArticles(int $amount): void
    {
        $faker = Factory::create("es_ES");
        for ($i = 0; $i < $amount; $i++) {
            (new Article)
                ->setName(ucwords($faker->unique()->words(random_int(1, 3), true)))
                ->setDescription($faker->text())
                ->setAvailability($faker->randomElement(["YES", "NO"]))
                ->setCategoryId($faker->randomElement(Category::getCategoriesId()))
                ->create();
        }
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

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of availability
     */
    public function getAvailability(): string
    {
        return $this->availability;
    }

    /**
     * Set the value of availability
     */
    public function setAvailability(string $availability): self
    {
        $this->availability = strtoupper($availability);

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     */
    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }
}
