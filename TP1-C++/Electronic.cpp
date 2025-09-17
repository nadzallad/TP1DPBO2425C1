#include <bits/stdc++.h>
using namespace std;

class Electronic {
private:
    string id_toko;
    string product_name;
    string category;
    int price;

public:
    // Constructor
    Electronic(string id, string name, string cat, int prc) {
        id_toko = id;
        product_name = name;
        category = cat;
        price = prc;
    }

    // Getters
    string getId() {
        return id_toko;
    }

    string getProductName() {
        return product_name;
    }

    string getCategory() {
        return category;
    }

    int getPrice() {
        return price;
    }

    // Setters
    void setId(string id) {
        id_toko = id;
    }

    void setProductName(string name) {
        product_name = name;
    }

    void setCategory(string cat) {
        category = cat;
    }

    void setPrice(int prc) {
        price = prc;
    }

    // Display product info
    void productInformation() {
        cout << "Kode: " << getId() << endl;
        cout << "Nama: " << getProductName() << endl;
        cout << "Kategori: " << getCategory() << endl;
        cout << "Harga: Rp " << fixed << setprecision(0) << getPrice() << endl;
        cout << string(30, '-') << endl;
    }
};
