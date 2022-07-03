from flask import Flask

app = Flask(__name__)

@app.route("/api/discountCalculator/<total>")
def process(total=None):
    totalPrice = float(total)
    discountRate = 0
    if totalPrice >= 10000:
        discountRate = 0.12
    elif totalPrice >= 5000:
        discountRate = 0.08
    elif totalPrice >= 3000:
        discountRate = 0.03

    # processing of request data goes here ...
    response_data = {"discountRate": discountRate}
    return response_data


if __name__ == "__main__":
    app.run(debug=True,
            host='127.0.0.1',
            port=8080)
