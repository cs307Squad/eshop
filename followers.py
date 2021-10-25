from django.db import models
import google.cloud.sql.connector as connector
from google.cloud import storage
import os

os.environ["GOOGLE_APPLICATION_CREDENTIALS"] = "C:/Users/Lenovo/Downloads/eshopserver-9b6af4865a97.json"

storage_client = storage.Client()
buckets = list(storage_client.list_buckets())

db_connection = connector.connect("eshopserver:us-central1:tables", "pymysql", user='root',
                                  password='JulianNagelsmann',
                                  host='34.71.136.78',
                                  db='eshop')
db_cursor = db_connection.cursor()
db_cursor.execute("SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED")
db_cursor.execute("USE eshop")


class Customer:
    id = models.IntegerField()
    user_name = models.TextField()
    password = models.TextField()
    website_id = models.IntegerField()
    account_number = models.IntegerField()
    city = models.TextField()
    state = models.TextField()
    country = models.TextField()
    email = models.TextField()
    follow_count = models.IntegerField()


def update_follower_count(customer_id, count):
    get_customer = '''SELECT follow_count FROM Customer WHERE Customer_ID = %s;'''
    update_followers = '''UPDATE Customer SET follow_count = %s WHERE Customer_ID = %s;'''
    db_cursor.execute(get_customer, (customer_id))
    data = db_cursor.fetchone()

    if data == None:
        print("no customer")

    new_count = data[0]

    if new_count == None:
        new_count = count
    else:
        new_count += count

    db_cursor.execute(update_followers, (new_count, customer_id))
    db_connection.commit()


def add_follower(customer_id, following_id):
    add_new_follower = '''INSERT INTO Followers VALUES (%s,%s);'''
    db_cursor.execute(add_new_follower, (customer_id, following_id))
    update_follower_count(customer_id, 1)
    db_connection.commit()


def print_followers(customer_id):
    get_followers = '''SELECT followingID FROM Followers WHERE followerID = %s;'''
    db_cursor.execute(get_followers, (customer_id))
    fetch_data = db_cursor.fetchall()
    print(fetch_data)


def print_customers(fetch_data):
    for data in fetch_data:
        print(data)


if __name__ == "__main__":
    add_follower(1,6)
    print_followers(1)
