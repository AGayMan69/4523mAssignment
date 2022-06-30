'''
How to create a simple REST API with Python and Flask in 5 minutes
https://medium.com/duomly-blockchain-online-courses/how-to-create-a-simple-rest-api-with-python-and-flask-in-5-minutes-94bb88f74a23
https://pythonbasics.org/flask-tutorial-routes/
run : pip install flask
Testing :
URL : http://127.0.0.1:8080/api/apple/30
output on browser :
{
  "para1": "apple",
  "para2": "30"
}
'''

from flask import Flask

app = Flask(__name__)

@app.route("/api/discountCalculator/<total>")
def process(total=None):
    discountRate = 0
    totalPrice = float(total)
    if totalPrice>=10000:
        discountRate=0.12
    elif totalPrice>=5000:
        discountRate=0.08
    elif totalPrice>=3000:
        discountRate=0.03
    else:
        discountRate=0

    # processing of request data goes here ...
    response_data = {"discountRate": discountRate}
    return response_data

if __name__ == "__main__":
    app.run(debug=True,
            host='127.0.0.1',
            port=8080)
