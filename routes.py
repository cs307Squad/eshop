from dominate import document
from flask import render_template, request, jsonify, url_for, redirect
from flask import render_template, request, jsonify, url_for
from __main__ import app
import src.models
import mysql.connector as connector

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

def product_table(data):
    if data == None:
        return ""
    table = "<table border = '1'>"
    table = table + "<tr><th>Name</th><th>Code</th><th>Price</th>" \
                    "<th>Rating</th><th>Number_Rating</th><th>Review</th></tr>"
    for (Name, Product_Code, Price, Rating, Number_Rating,Image_Url) in data:
        table = table + "<tr>\n"
        table = table + "<td>" + str(Name)[0:34] + "</td>"
        table = table + "<td>" + str(Product_Code) + "</td>"
        table = table + "<td>" + str(Price) + "</td>"
        table = table + "<td>" + str(Rating) + "</td>"
        table = table + "<td>" + str(Number_Rating) + "</td>"
        table = table + "<td>" + str(Image_Url) + "</td>"
        table = table + "</tr>\n"
    table = table + "</table>"
    return table

@app.route('/', methods=['POST', 'GET'])
def search(res):
    if request.method == 'POST':
        result = src.models.get_product(res)
        return redirect(url_for('find'))
    else:
        return render_template('home.html')

@app.route('/results')
def find():
    res = request.args["re"]
    result = src.models.get_product(res)
    select = document.getElementById("column")
    if select = ''
    return render_template('results.html', products=product_table(result))

@app.route('/submit')
def add(p_code):
    res = request.args["rev"]
    result = res[0]
    submit_sql = "UPDATE Review SET Review =  " + result + " WHERE Product_Code = " + p_code
    db_cursor.execute(submit_sql)


@app.route('/product/<int:product_code>')
def review(product_code):
    get_reviews_sql = "SELECT * FROM Review WHERE Product_Code = " + product_code
    db_cursor.execute(get_reviews_sql)
    Reviews = []
    for Review in db_cursor.fetchall():
        Reviews.append({Review[1]})
    get_name_sql = "SELECT Name FROM Product WHERE Product_Code = " + product_code
    db_cursor.execute(get_name_sql)
    names = []
    for name in db_cursor.fetchall():
        names.append({name[0]})
    return render_template('reviews.html', code=product_code, name=names[0], reviews=Reviews)
