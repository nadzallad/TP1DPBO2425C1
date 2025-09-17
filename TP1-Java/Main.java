import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        // membuat list untuk menyimpan produk elektronik
        ArrayList<Electronic> productList = new ArrayList<>();
        // scanner unutk membaca input dari user
        Scanner scanner = new Scanner(System.in);

        // Initial products, menambah data awal ke dalam daftar
        productList.add(new Electronic("E001", "Laptop Asus", "Laptop", 8500000));
        productList.add(new Electronic("E002", "HP Samsung Galaxy", "Smartphone", 3500000));
        productList.add(new Electronic("E003", "Smart TV LG", "Televisi", 5200000));

        // variabel kontrol unutk loop menu utama
        boolean isRunning = true;

        // Loop utama program - menampilkan menu dan menjalankan pilihan user
        while (isRunning) {
            System.out.println("\n== Electronics Store ==");
            System.out.println("1. See all products");
            System.out.println("2. Add product");
            System.out.println("3. Update product");
            System.out.println("4. Delete product");
            System.out.println("5. Search product");
            System.out.println("6. Exit");
            System.out.print("Select an option (1-6): ");
            String choice = scanner.nextLine();

            switch (choice) {
                // Menampilkan semua produk yang ada di daftar
                case "1":
                    System.out.println("\n== Product List ==");
                    for (Electronic e : productList) {
                        e.printInformation();
                    }
                    break;

                // Menambahkan produk baru
                case "2":
                    System.out.println("\n== Add Product ==");
                    System.out.print("Product ID     : ");
                    String id = scanner.nextLine();

                    // Cek apakah ID sudah ada
                    boolean idExists = false;
                    for (Electronic e : productList) {
                        if (e.getIdToko().equalsIgnoreCase(id)) {
                            idExists = true;
                            break;
                        }
                    }

                    if (idExists) {
                        System.out.println("Error: Product ID sudah ada. Silakan gunakan ID lain.");
                    } else {
                        System.out.print("Product Name   : ");
                        String name = scanner.nextLine();
                        System.out.print("Product Category: ");
                        String category = scanner.nextLine();
                        System.out.print("Price          : ");
                        int price = Integer.parseInt(scanner.nextLine());

                        productList.add(new Electronic(id, name, category, price));
                        System.out.println("Product added!");
                    }
                    break;

                // Update data produk berdasarkan ID
                case "3":
                    System.out.println("\n== Update Product ==");
                    System.out.print("Enter Product ID: ");
                    String updateId = scanner.nextLine();
                    boolean foundUpdate = false;

                    for (Electronic e : productList) {
                        if (e.getIdToko().equals(updateId)) {
                            System.out.print("New Name     : ");
                            String newName = scanner.nextLine();
                            System.out.print("New Category : ");
                            String newCategory = scanner.nextLine();
                            System.out.print("New Price    : ");
                            int newPrice = Integer.parseInt(scanner.nextLine());

                            e.setProductName(newName);
                            e.setCategory(newCategory);
                            e.setPrice(newPrice);

                            System.out.println("Product updated!");
                            foundUpdate = true;
                        }
                    }

                    if (!foundUpdate) {
                        System.out.println("Product ID not found.");
                    }
                    break;

                // Menghapus produk berdasarkan ID
                case "4":
                    System.out.println("\n== Delete Product ==");
                    System.out.print("Enter Product ID to delete: ");
                    String deleteId = scanner.nextLine();
                    int indexToDelete = -1;

                    for (int i = 0; i < productList.size(); i++) {
                        if (productList.get(i).getIdToko().equals(deleteId)) {
                            indexToDelete = i;

                        }
                    }

                    if (indexToDelete != -1) {
                        productList.remove(indexToDelete);
                        System.out.println("Product deleted!");
                    } else {
                        System.out.println("Product ID not found.");
                    }
                    break;

                // Mencari produk berdasarkan ID, nama, atau kategori
                case "5":
                    System.out.println("\n== Search Product ==");
                    System.out.print("Enter product ID or Name or Category to search: ");
                    String keyword = scanner.nextLine().toLowerCase(); // case-insensitive search

                    boolean found = false;

                    // Loop untuk cari produk yang cocok dengan keyword
                    for (Electronic product : productList) {
                        String id_search = product.getIdToko().toLowerCase();
                        String name_search = product.getProductName().toLowerCase();
                        String category_search = product.getCategory().toLowerCase();

                        if (id_search.equals(keyword) || name_search.equals(keyword)
                                || category_search.equals(keyword)) {
                            // Jika ketemu, tampilkan informasi produk
                            System.out.println("Product found:");
                            System.out.println(" ID       : " + product.getIdToko());
                            System.out.println(" Name     : " + product.getProductName());
                            System.out.println(" Category : " + product.getCategory());
                            System.out.println(" Price    : " + product.getPrice());
                            found = true;
                        }
                    }
                    // Jika tidak ada produk yang cocok, tampilkan pesan
                    if (!found) {
                        System.out.println("Product not found!");
                    }
                    break;
                
                // Keluar dari program
                case "6":
                    System.out.println("Exiting program.");
                    isRunning = false;
                    break;
                    
                // Jika pilihan tidak valid, tampilkan pesan error
                default:
                    System.out.println("Invalid choice. Try again.");
            }
        }

        scanner.close();
    }
}
