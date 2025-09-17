class Electronic:

    #attribute declaration
    def __init__(self, id_toko: str, product_name: str, category: str, price: int):
        self.__id_toko= str(id_toko)
        self.__product_name = str(product_name)
        self.__category = str(category)
        self.__price = int(price)

    #getter and setter for id attribute 
    def getId(self)->str:
        return self.__id_toko
    
    def setId(self, id_toko: str)->None:
        self.__id_toko = str(id_toko)

    #getter for product nama attribute 
    def getProductName(self)->str:
        return self.__product_name
    
    def setProductName(self, product_name: str)->None:
        self.__product_name = str(product_name)
    
    #getter for category attribute 
    def getCategory(self)->str:
        return self.__category
    
    def setCategory(self, product_name: str)->None:
        self.__category = str(product_name)
    
    #getter for price attribute 
    def getPrice(self)->int:
        return self.__price
    
    def setPrice(self, price: int)->None:
        self.__price = int(price)

    #function to display product information
    def product_information(self):
        print(f"Kode: {self.getId()}") #display id
        print(f"Nama: {self.getProductName()}") #display product name
        print(f"Kategori: {self.getCategory()}") #display  product category
        print(f"Harga: Rp {self.getPrice():,}") #display product price
        print("-" * 30)
    

