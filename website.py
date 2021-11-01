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


class Website:
    id = models.IntegerField()
    name = models.CharField()
    page_id = models.IntegerField()
    javascript_files = models.TextField()
    html_files = models.TextField()

def get_last_save(id):
    get_website_sql = "SELECT * FROM Website WHERE Website_ID=%s;"
    db_cursor.execute(get_website_sql, [id])
    data = db_cursor.fetchone()
    if data is None:
        print("website error")
        return None

    website = Website()

    website.id = id
    website.name = data[1]
    website.page_id = data[2]
    website.javascript_files = data[3]
    website.html_files = data[4]

    return website

def revert_changes(website, website_id):
    previous = get_last_save(id)

    website.id = previous.id
    website.name = previous.name
    website.page_id = previous.page_id
    website.javascript_files = previous.javascript_files
    website.html_files = previous.html_files





