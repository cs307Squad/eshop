import mysql.connector as connector
from src import config

db_connection = None
db_cursor = None

try:
    db_connection = connector.connect(user=config.db_user,
                                      password=config.db_password,
                                      host=config.db_host,
                                      database=config.db_name)
except connector.Error as err:
    print(err)

db_cursor = db_connection.cursor(buffered=True)
db_cursor.execute("SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED")
db_cursor.execute("USE eshop")
get_login_cus_sql = "SELECT User_Name, Password FROM Customer WHERE User_Name = %s AND Password = %s "
get_login_mer_sql = "SELECT User_Name, Password FROM Merchant WHERE User_Name = %s AND Password = %s "
get_customer_sql = "SELECT Customer_ID FROM Customer WHERE User_Name = %s"
update_product_sql = "UPDATE Product SET Rating = CONCAT(SUBSTR(ROUND((SELECT Total_Score / Score_Count FROM (SELECT * FROM Product) a WHERE a.Product_Code = %s),1),0,3)," \
                     "' out of 5 stars') WHERE Product_Code = %s"
check_product_sql = "SELECT Total_Score / Score_Count " \
                     "FROM (SELECT * FROM Product) a WHERE a.Product_Code = %s"
update_rating_sql = "INSERT INTO Reviews( Product_Code, Reviews, Customer_ID, Score) VALUES ( %s, %s, %s, %s)"
update_web_sql = "INSERT INTO Website( Name, Category) VALUES ( %s, %s)"
get_rating_sql = "SELECT r.Reviews, c.User_Name, r.Score FROM Reviews r JOIN Customer c ON r.Customer_ID = c.Customer_ID" \
                 " WHERE Product_Code = %s"
get_products_name_sql = "SELECT * FROM Product WHERE Name LIKE "
get_products_url_sql = "SELECT * FROM Product WHERE Url LIKE "
get_products_rating_sql = "SELECT * FROM Product WHERE Rating LIKE "
get_products_price_sql = "SELECT * FROM Product WHERE Price = %s"
get_products_nrate_sql = "SELECT * FROM Product WHERE Num_Rating = %s"
get_products_qstock_sql = "SELECT * FROM Product WHERE Qty_In_Stock = %s"
get_products_image_sql = "SELECT * FROM Product WHERE Image_Url LIKE "
get_products_pcode_sql = "SELECT * FROM Product WHERE Product_Code = %s"
get_products_ptype_sql = "SELECT * FROM Product WHERE Product_Type LIKE "
get_products_cat_sql = "SELECT * FROM Product WHERE Category = %s"
get_site_sql = "SELECT Category FROM Website WHERE Name = %s"

def get_site(a):
    db_cursor.execute(get_site_sql, (a,))
    res = []
    for b in db_cursor.fetchall():
        res.append(b[0])
    return res

def check_product(a):
    db_cursor.execute(check_product_sql,(a,))
    res = []
    for b in db_cursor.fetchall():
        res.append(b[0])
    return res

def update_web(a,b):
    db_cursor.execute(update_web_sql, (a, b))
    db_connection.commit()

def update_product(a):
    db_cursor.execute(update_product_sql, (a, a))
    db_connection.commit()

def get_customer(a):
    db_cursor.execute(get_customer_sql, (a,))
    customer = []
    for c in db_cursor.fetchall():
        customer.append(c[0])
    return customer


def login_cus(a, b):
    db_cursor.execute(get_login_cus_sql, (a, b))
    logins = []
    for login in db_cursor.fetchall():
        logins.append({"user": login[0], "pass": login[1]})
    return logins

def login_mer(a, b):
    db_cursor.execute(get_login_mer_sql, (a, b))
    logins = []
    for login in db_cursor.fetchall():
        logins.append({"user": login[0], "pass": login[1]})
    return logins


def update_rating(a, b, c, d):
    db_cursor.execute(update_rating_sql, (a, b, c, d))
    db_connection.commit()


def get_rating(name):
    db_cursor.execute(get_rating_sql, (str(name),))
    ratings = []
    for rate in db_cursor.fetchall():
        ratings.append({"review": rate[0], "customer": rate[1], "rating": rate[2]})
    return ratings


def get_products_name(name,nam):
    get_products_names_sql = get_products_name_sql + "'%" + name + "%' " + "AND Category = " + "'" + nam + "'"
    db_cursor.execute(get_products_names_sql)
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_url(name):
    get_products_urls_sql = get_products_url_sql + "'%" + name + "%'"
    db_cursor.execute(get_products_urls_sql)
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_rating(name):
    get_products_ratings_sql = get_products_rating_sql + "'%" + name + "%'"
    db_cursor.execute(get_products_ratings_sql)
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_price(name):
    db_cursor.execute(get_products_price_sql, (int(name),))
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_nrate(name):
    db_cursor.execute(get_products_nrate_sql, (int(name),))
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_qstock(name):
    db_cursor.execute(get_products_qstock_sql, (int(name),))
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_image(name):
    get_products_images_sql = get_products_image_sql + "'%" + name + "%'"
    db_cursor.execute(get_products_images_sql)
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_pcode(name):
    db_cursor.execute(get_products_pcode_sql, (int(name),))
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_ptype(name):
    get_products_ptypes_sql = get_products_ptype_sql + "'%" + name + "%'"
    db_cursor.execute(get_products_ptypes_sql)
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products


def get_products_cat(name):
    db_cursor.execute(get_products_cat_sql, (str(name),))
    products = []
    for product in db_cursor.fetchall():
        products.append(
            {"Product_Code": product[0], "Productline_ID": product[1], "Url": product[2],
             "Rating": product[3], "Number_Rating": product[4], "Image_Url": product[5],
             "Name": product[6], "Scale": product[7], "Description": product[8],
             "Qty_In_Stock": product[9], "Price": product[10], "MSRP": product[11],
             "Product_Type": product[12], "Category": product[13]})
    return products
