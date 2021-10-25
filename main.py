import pandas as pd
from flask import Flask, render_template
# from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)

if __name__ == "__main__":
    app.run(debug=True)



filepath = '/Users/saatvikanumalasetty/Downloads/Products.csv'

def printFile(file):
    productDf = pd.read_csv(file)
    return productDf

products = printFile(filepath)

#preprocessing the dataframe

def trimRating(products):
    ratings = products['Rating'].str.split(' ').str[0]
    ratings = list(ratings)
    ratings = list(map(float, ratings))
    products['Rating'] = ratings
    return products

def trimPopularity(products):
    numberRatings = list(products['Number_Rating'])
    ratings = list(map(float, numberRatings))
    products['Number_Rating'] = ratings
    return products

def sortByRating(products):
    products = products.sort_values('Rating', ascending = False)
    return products

def sortByPopularity(products):
    products = products.sort_values('Number_Rating', ascending = False)
    return products



products = trimRating(products)
products = trimPopularity(products)
sortProductsByRating = sortByRating(products)
sortProductsByPopularity = sortByPopularity(products)


headings = sortProductsByRating.columns
data = sortProductsByRating.values.tolist()

@app.route('/', methods = ['GET'])
def table():
    return render_template('table.html', heading = headings, data = data)













