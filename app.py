from flask import Flask
from dominate import document
from bs4 import BeautifulSoup
from src import config
from flask import render_template, request, jsonify, url_for, redirect
from flask import render_template, request, jsonify, url_for
import src.models
import mysql.connector as connector
# import xml.dom.minidom as m
# doc = m.parse(r"C:/Users/pc/Downloads/eshop-io/eshop/src/templates/home.html")

import js2py

# js2py.translate_file('src/templates/Nice.js', 'Verynice.py')
# import Verynice
# from Verynice import *

app = Flask(__name__, template_folder='C:/Users/pc/Downloads/eshop-io/eshop/src/templates')

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
                    "<th>Rating</th><th>Number_Rating</th><th>Image_Url</th></tr>"
    for i in range(len(data)):
        table = table + "<tr>\n"
        table = table + "<td>" + str(data[i][6]) + "</td>"
        table = table + "<td>" + str(data[i][0]) + "</td>"
        table = table + "<td>" + str(data[i][10]) + "</td>"
        table = table + "<td>" + str(data[i][3]) + "</td>"
        table = table + "<td>" + str(data[i][4]) + "</td>"
        table = table + "<td>" + str(data[i][5]) + "</td>"
        table = table + "</tr>\n"
    table = table + "</table>"
    return table


@app.route('/', methods=['POST', 'GET'])
def login():
    if request.method == 'POST':
        logins = []
        username = request.form['username']
        print('user is: ' + str(username))
        password = request.form['password']
        logins = src.models.login(username, password)
        if not logins:
            return render_template('nope.html')
        else:
            return redirect(url_for('search', usr=username))
    else:
        return render_template('login.html')


@app.route('/login/<usr>', methods=['POST', 'GET'])
def search(usr):
    if request.method == 'POST':
        res = request.form['re']
        select = request.form.get('col')
        if str(select) == "url" or str(select) == "image_url":
            res = res[res.rfind('/') + 1:len(res) - 1]
        return redirect(url_for('find', us=usr, rs=res, sl=select))
    else:
        return render_template('home.html')


@app.route('/<us>/<sl>/<rs>')
def find(us, rs, sl):
    print("select is: " + str(sl))
    print("res is:" + str(rs))
    result = []
    if str(sl) == "url":
        result = src.models.get_products_url(rs)
    elif str(sl) == "rating":
        result = src.models.get_products_rating(rs)
    elif str(sl) == "price":
        result = src.models.get_products_price(rs)
    elif str(sl) == "num_rating":
        result = src.models.get_products_nrate(rs)
    elif str(sl) == "qty_in_stock":
        result = src.models.get_products_qstock(rs)
    elif str(sl) == "product_code":
        result = src.models.get_products_pcode(rs)
    elif str(sl) == "product_type":
        result = src.models.get_products_ptype(rs)
    elif str(sl) == "category":
        result = src.models.get_products_cat(rs)
    elif str(sl) == "image_url":
        result = src.models.get_products_image(rs)
    else:
        result = src.models.get_products_name(rs)
    print("result is: " + str(result))
    # usrid = src.models.get_customer(us)
    return render_template('results.html', usr=us, products=result)


@app.route('/submit')
def add(p_code):
    res = request.args["rev"]
    result = res[0]
    submit_sql = "UPDATE Review SET Review =  " + result + " WHERE Product_Code = " + p_code
    db_cursor.execute(submit_sql)


@app.route('/<user>/product/<product_code>', methods=["POST", "GET"])
def review(user, product_code):
    if request.method == "POST":
        rating = request.form.get("rating")
        review = request.form['review']
        src.models.update_rating(product_code, review, user, rating)
        rev = []
        rev = src.models.get_rating(str(product_code))
        return render_template('reviews.html', reviews=rev)
    else:
        rev = []
        rev = src.models.get_rating(str(product_code))
        print("rev is: " + str(rev))
        return render_template('reviews.html', reviews=rev)


if __name__ == '__main__':
    app.run(threaded=True, port=5000, debug=True)
