import cascade as cascade
import mysql.connector as connector
import src.config as config
from django.db import models


class Review:
    rating_count = models.IntegerField()
    total_rating = models.IntegerField()
    average_rating = models.IntegerField()

    message = models.TextField()
    user = models.ForeignKey('User')



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


def get_review(id):
    get_review_sql = "SELECT * FROM Review WHERE Review.id=id;"
    db_cursor.execute(get_review_sql)
    review = Review()

    fetch_data = db_cursor.fetchone()

    review.message = fetch_data[0]
    review.user = fetch_data[1]
    review.rating_count = fetch_data[2]
    review.total_rating = fetch_data[3]
    review.average_rating = fetch_data[4]

    return review


def add_rating(review, score):






