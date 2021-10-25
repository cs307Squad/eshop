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


class Review:
    product_id = models.IntegerField()
    id = models.IntegerField()
    body = models.TextField()
    rating_count = models.IntegerField()
    total_rating = models.IntegerField()
    user_id = models.IntegerField()


def get_review(id):
    get_review_sql = "SELECT * FROM Reviews WHERE ID=%s;"
    db_cursor.execute(get_review_sql, [id])
    review = Review()
    fetch_data = db_cursor.fetchone()

    if fetch_data == None:
        print("No review with that id")
        return None

    print(fetch_data)
    review.product_id = fetch_data[0]
    review.message = fetch_data[1]
    review.total_rating = fetch_data[2]
    review.rating_count = fetch_data[3]
    review.user_id = fetch_data[4]
    review.id = fetch_data[5]

    return review


def add_rating(review, score):
    id = review.id
    new_count = review.rating_count + 1
    new_total_rating = review.total_rating + score
    update_review = '''UPDATE Reviews SET Score_Count = %s, Total_Score = %s WHERE ID = %s;'''
    db_cursor.execute(update_review, (new_count, new_total_rating, id))
    db_connection.commit()


def like_rating(id, like):
    review = get_review(id)
    if review is None:
        return

    if like:
        add_rating(review, 1)
    else:
        add_rating(review, -1)


def add_review(content, product_id, score):
    new_review = '''INSERT INTO Reviews (message, productID)VALUES(%s, %s);'''
    db_cursor.execute(new_review, (content, product_id))
    if score is not None:
        add_product_rating(score, product_id)

    db_connection.commit()


def add_product_rating(product_id, score):
    add_product_rating = '''UPDATE Reviews SET Rating_Score = %s WHERE ProductID = %s;'''
    db_cursor.execute(add_product_rating, (score, product_id))
    db_connection.commit()


if __name__ == "__main__":
    like_rating(1, True)
    get_review(1)
