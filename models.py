import mysql.connector as connector
import src.config as config

db_connection = None
db_cursor = None

try:
    db_connection = connector.connect(user=config.db_user,
                                      password=config.db_password,
                                      host=config.db_host,
                                      database=config.db_name)
except connector.Error as err:
    print("ERROR")

db_cursor = db_connection.cursor(buffered=True)
db_cursor.execute("SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED")
db_cursor.execute("USE eshop")

get_products_sql = "SELECT * FROM Product WHERE Name LIKE '%%%s%%'"

def get_products(name):
    db_cursor.execute(get_products_sql,(name))
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products
