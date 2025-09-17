from Electronic import Electronic

def main():

    #funtion to save product list 
    product_list = [
    Electronic("E001", "Laptop Asus", "Laptop", 8500000),
    Electronic("E002", "HP Samsung Galaxy", "Smartphone", 3500000),
    Electronic("E003", "Smart TV LG", "Televisi", 5200000),
    ]
     

    #program to choose what to do 
    while True:
        print("\n == Electronics Store == ")
        print("1. see all products ")
        print("2. add product ")
        print("3. update product ")
        print("4. delete product")
        print("5. search product")
        print("6. exit")

        #input 1-6
        pilihan = input("select 1 - 6 : ")

        match pilihan:
            # 1 for display product list
            case "1" :
                print("\n== Product List==")
                for products in product_list:
                    products.product_information()

            # 2 for add a new product
            case "2":
                print("\n== Add Product ==")
                ID = input("product ID :")
                duplicate = False
                for product in product_list:
                        if product.getId() == ID:
                            duplicate = True
                           
                if duplicate:
                    print("Product with this ID already exists! Please use a unique ID.")
                else:
                    Name = input("Product Name :")
                    Category = input("Product Category:")
                    Price = int(input("Price:"))
                    product_list.append(Electronic(ID, Name, Category, Price))
                    print("Product added!")
                            
            # 3 to update the product
            case "3":
                print("\n== Update Product ==")
                ID = input("Enter Product ID: ")
                found = False
                for products in product_list:
                    #if input id == id in product list
                    if products.getId() == ID:
                        #update name, category and product price
                        name = input("New Name : ")
                        category = input("New Category : ")
                        price = int (input("New Price : "))
                        products.setProductName(name)
                        products.setCategory(category)
                        products.setPrice(price)
                        print("updated")
                        found = True
                # if id not found
                if not found:
                    print("product Id not found")
            
            # 4 to delete the product
            case "4":
                print("== Delete Product")
                ID = input("Enter Id for delete product :")
                found = False
                for products in product_list:
                    if products.getId() == ID:
                        product_list.remove(products)
                        print("Product deleted!")
                        found = True
                if not found:
                    print("Product Id not found!")

            case "5":
                print("== Search Product ==")
                keyword = input("Enter product Id or name or category to search: ").lower()
                found = False
                for product in product_list:
                    # Misal produk punya method getId() dan getName()
                    if product.getId().lower() == keyword or product.getProductName().lower() == keyword or product.getCategory().lower() == keyword:
                        print(f"Product found:")
                        print(f" Id={product.getId()}")
                        print(f" Name = {product.getProductName()}")
                        print(f" Category = {product.getCategory()}")
                        print(f" Price = {product.getPrice()}")
                        found = True
                if not found:
                    print("Product not found!")
            
            case "6":
                print("exiting program...")
                exit()

if __name__ == "__main__":
    main()