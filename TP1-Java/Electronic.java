public class Electronic {
    private String idToko;
    private String productName;
    private String category;
    private int price;

    public Electronic(String idToko, String productName, String category, int price) {
        this.idToko = idToko;
        this.productName = productName;
        this.category = category;
        this.price = price;
    }

    // Getters
    public String getIdToko() {
        return idToko;
    }

    public String getProductName() {
        return productName;
    }

    public String getCategory() {
        return category;
    }

    public int getPrice() {
        return price;
    }

    // Setters
    public void setIdToko(String idToko) {
        this.idToko = idToko;
    }

    public void setProductName(String productName) {
        this.productName = productName;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public void setPrice(int price) {
        this.price = price;
    }

    // Display method
    public void printInformation() {
        System.out.println("Kode     : " + idToko);
        System.out.println("Nama     : " + productName);
        System.out.println("Kategori : " + category);
        System.out.printf("Harga    : Rp %,d\n", price);
        System.out.println("------------------------------");
    }
}
