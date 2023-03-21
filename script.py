from flask import Flask, render_template
import random

app = Flask(__name__)

random_dec = random.random()

#@app.route("/update_decimal", methods = ["POST"])
#def updatedecimal():
#  random_dec = random.random()

@app.route("/")
def homepage():
  return render_template("index.html")

@app.route("/god")
def play():
  return "wassup"

@app.route("/start")
def start():
  return render_template("index.html")

@app.route("/login")
def login():
  return render_template("login.html")

@app.route("/signup")
def sign_up():
  return render_template("signup.html")

@app.route("/main")
def main():
  return render_template("main.html")

if __name__ == "__main__":
  app.run(debug = True)