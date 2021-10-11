import mysql.connector as connector
import src.config as config


class Website:
    id = 0
    html_data = ""
    # class to be completed.


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


def get_website(website_id):
    get_website_sql = "SELECT * FROM WEBSITE w WHERE w.ID = website_id;"
    db_cursor.execute(get_website_sql)
    return db_cursor.fetchone()


def change_website_to_last_save(current_website, old_website_cursor):
    exit()
    # to complete after website class figured out
