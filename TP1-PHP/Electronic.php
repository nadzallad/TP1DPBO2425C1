<?php

class Electronic {
    // Attribute declaration (private)
    private string $id_toko;
    private string $product_name;
    private string $category;
    private int $price;
    private string $image_file_name;

    // Constructor
    public function __construct(string $id_toko, string $product_name, string $category, int $price, string $image_file_name ="") {
        $this->id_toko = $id_toko;
        $this->product_name = $product_name;
        $this->category = $category;
        $this->price = $price;
        $this->image_file_name = $image_file_name;
    }

    // Getter and Setter for id_toko
    public function getId(): string {
        return $this->id_toko;
    }

    public function setId(string $id_toko): void {
        $this->id_toko = $id_toko;
    }

    // Getter and Setter for product_name
    public function getProductName(): string {
        return $this->product_name;
    }

    public function setProductName(string $product_name): void {
        $this->product_name = $product_name;
    }

    // Getter and Setter for category
    public function getCategory(): string {
        return $this->category;
    }

    public function setCategory(string $category): void {
        $this->category = $category;
    }

    // Getter and Setter for price
    public function getPrice(): int {
        return $this->price;
    }

    public function setPrice(int $price): void {
        $this->price = $price;
    }
    
    // Getter and Setter for Image
    public function getImageFileName(): string {
    return $this->image_file_name;
}

public function setImageFileName(string $fileName): void {
    $this->image_file_name = $fileName;
}
}

?>