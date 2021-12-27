# import pandas as pd
# from sklearn.tree import DecisionTreeClassifier # Import Decision Tree Classifier
# import random

# # customers = pd.read_csv("/Users/saatvikanumalasetty/Desktop/phpCRUDappCS307/Recommed_stores_week_2/companies/uniorn_companies.csv")
# companies = pd.read_excel("/Users/saatvikanumalasetty/Desktop/phpCRUDappCS307/Recommed_stores_week_2/companies/segmentationdatalegend.xlsx")

# customers

# companies

# companies.Category.value_counts()

# categoryList = list(set(companies.Category))
# print(categoryList)

# categoryList.remove('Data management & analytics<')

# categoryList.remove('Education')

# len(categoryList)

# numberOfCustomers = len(customers)
# categories_for_customers = []
# for i in list(range(1, numberOfCustomers + 1)):
#   index = random.randint(0,len(categoryList) - 1)
#   categories_for_customers.append(categoryList[index])

# customers['Fav_type'] = categories_for_customers

# customers

# customers['Fav_type'].value_counts()

# # Create Decision Tree classifer object
# clf = DecisionTreeClassifier()

# # Train Decision Tree Classifer
# clf = clf.fit(customers.iloc[:,1:7],customers['Fav_type'])

# customers.iloc[:,1:7]

# customers.info()

# random_customer = [0, 0, 60, 2, 10000, 0]


# print(clf.predict([random_customer]))

# import json 

# D = {'foo': 1, 'baz':2}

# print(json.dumps(D))

# import sys

# input = ""
# if len(sys.argv) > 1:
    # print(sys.argv[1] + "hello")

from flask import Flask, render_template, request
from flask.helpers import url_for
from werkzeug.utils import redirect

app = Flask(__name__)

@app.route('/', methods = ['POST', 'GET'])
def home():
  if request.method == "POST":
      age = request.form["age"]
      income = request.form["income"]
      gender = request.form["gender"]
      marital = request.form["marital"]
      education = request.form["education"]
      occupation = request.form["occupation"]
      city = request.form["city"]
      print(age)
      return render_template('userForm.html')


  else:
    return render_template('userForm.html')

@app.route('/prediction', methods = ['POST', 'GET'])
def prediction(list1):
  return list1

if __name__ == "__main__":
  app.run()
    


# import sys

# if len(sys.argv) > 1:
    #print(sys.argv[1])
