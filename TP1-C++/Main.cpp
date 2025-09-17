 #include "Electronic.cpp" //impor class elektronik 


int main() {
    // Inisialisasi daftar produk awal
    vector<Electronic> product_list = {
        Electronic("E001", "Laptop Asus", "Laptop", 8500000),
        Electronic("E002", "HP Samsung Galaxy", "Smartphone", 3500000),
        Electronic("E003", "Smart TV LG", "Televisi", 5200000)
    };

     // Flag untuk mengontrol loop menu utama
    bool isRunning = true;

    while (isRunning) {
        // Tampilkan menu utama
        cout << "\n== Electronics Store ==" << endl;
        cout << "1. See all products" << endl;
        cout << "2. Add product" << endl;
        cout << "3. Update product" << endl;
        cout << "4. Delete product" << endl;
        cout << "5. Search product" << endl;
        cout << "6. Exit" << endl;

        // Input pilihan dari user
        cout << "Select an option (1-6): ";
        string choice;
        getline(cin, choice);

        // Opsi 1: Tampilkan seluruh produk
        if (choice == "1") {
            cout << "\n== Product List ==" << endl;
            for (auto& product : product_list) {
                product.productInformation();
            }
        }

        // Opsi 2: Tambah produk baru
        else if (choice == "2") {
            cout << "\n== Add Product ==" << endl;
            string id, name, cat;
            int prc;

            cout << "Product ID: ";
            getline(cin, id);

            // Cek apakah ID sudah ada
            bool idExists = false;
            for ( auto& product : product_list) {
                if (product.getId() == id) {
                    idExists = true;
                }
            }

            // Jika ID sudah ada, tolak input
            if (idExists) {
                cout << "Error: Product ID sudah ada. Silakan gunakan ID lain." << endl;
            } else {
                // Input data produk baru
                cout << "Product Name: ";
                getline(cin, name);
                cout << "Product Category: ";
                getline(cin, cat);
                cout << "Price: ";
                cin >> prc;
                cin.ignore(); // clear buffer

                // Tambahkan produk baru ke list
                product_list.push_back(Electronic(id, name, cat, prc));
                cout << "Product added!" << endl;
            }
        }


        // Opsi 3: Update data produk
        else if (choice == "3") {
            cout << "\n== Update Product ==" << endl;
            string id;
            cout << "Enter Product ID: ";
            getline(cin, id);

            bool found = false;
            // Cari produk berdasarkan ID
            for (auto& product : product_list) {
                if (product.getId() == id) {
                    // Input data baru
                    string name, cat;
                    int prc;
                    cout << "New Name: ";
                    getline(cin, name);
                    cout << "New Category: ";
                    getline(cin, cat);
                    cout << "New Price: ";
                    cin >> prc;
                    cin.ignore(); // clear buffer

                    // Update data produk
                    product.setProductName(name);
                    product.setCategory(cat);
                    product.setPrice(prc);
                    cout << "Product updated!" << endl;
                    found = true;
             
                }
            }

            // Jika ID tidak ditemukan
            if (!found) {
                cout << "Product ID not found." << endl;
                isRunning   = false;
            }
        }

        // Opsi 4: Hapus produk
        else if (choice == "4") {
            cout << "\n== Delete Product ==" << endl;
            string id;
            cout << "Enter ID to delete: ";
            getline(cin, id);

            bool found = false;
            int indexToDelete = -1;

            // Cari index produk yang mau dihapus
            for (int i = 0; i < (int)product_list.size(); i++) {
                if (product_list[i].getId() == id) {
                    indexToDelete = i;
                    found = true;
                }
            }

            if (found) {
                // Hapus produk di luar loop for
                product_list.erase(product_list.begin() + indexToDelete);
                cout << "Product deleted!" << endl;
            } else {
                cout << "Product ID not found!" << endl;
            }
        }
        
        // Opsi 5: Cari produk berdasarkan keyword
        else if (choice == "5") {
            cout << "\n== Search Product ==" << endl;
            string keyword;
            cout << "Enter product ID or Name or Category to search: ";
            getline(cin >> ws, keyword);

            bool found = false;

            for ( auto& product : product_list) {
                // Ambil ID atau Nama atau kategori, ubah ke lowercase 
                string id = product.getId();
                string name = product.getProductName();
                string category = product.getCategory();

                // Ubah ke lowercase
                transform(id.begin(), id.end(), id.begin(), ::tolower);
                transform(name.begin(), name.end(), name.begin(), ::tolower);
                transform(category.begin(), category.end(), category.begin(), ::tolower);
                string keyword_lower = keyword;
                transform(keyword_lower.begin(), keyword_lower.end(), keyword_lower.begin(), ::tolower);

                //jika ada yang cocok
                if (id == keyword_lower || name == keyword_lower || category == keyword_lower) {
                    cout << "Product found:\n";
                    cout << " ID       : " << product.getId() << endl;
                    cout << " Name     : " << product.getProductName() << endl;
                    cout << " Category : " << product.getCategory() << endl;
                    cout << " Price    : " << product.getPrice() << endl;
                    found = true;
                }
            }

            if (!found) {
                cout << "Product not found!" << endl;
            }
        }

        // Opsi 6: Keluar dari program
        else if (choice == "6") {
            cout << "Exiting program." << endl;
            return 0;
        }

        // Jika input pilihan tidak valid
        else {
            cout << "Invalid option. Try again." << endl;
        }
    }

    return 0;
}


