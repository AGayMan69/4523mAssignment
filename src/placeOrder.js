async function updateQuantity(id, price, input) {
    var data = {
        product: id,
        qty: input.value
    };
    const res = await fetch("updateCart.php", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json"
        }
    })

    const output = await res.json();
    const itemAmount = document.querySelector(`#row-${id}-amount`);
    itemAmount.innerHTML = "$" + (input.value * price);
}

async function addtoCart(addBtn) {
    // console.log(typeof addBtn.parentElement)
    var formData = new FormData(addBtn.parentElement);
    var data = {};
    formData.forEach((value, key) => data[key] = value);
    data['qty'] = 1;
    // console.log(data);
    const res = await fetch("addCart.php", {
        method: "POST",
        body: JSON.stringify(data),
        headers: {
            "Content-Type": "application/json"
        }
    })

    const output = await res.json();
    // checking cartRow exist
    var cartRow = `itemRow${data['itemID']}`;
    var cartRowClass = `tr.${cartRow}`;
    if (document.querySelector(cartRowClass) === null) {
        // adding innerhtml
        var shoppingCartRow = document.createElement('tr');
        shoppingCartRow.classList.add(cartRow);
        const htmlString = `
    <td>
        ${data['itemName']} 
    </td>
    
    <td>
            <input type="number" class="itemqty" name="qty" min="1" max="${data['stockQuantity']}" value="${data['qty']}"
            onchange="updateQuantity(${data['itemID']}, ${data['price']}, this)">
    </td>

    <td>$${data['price']}
    </td>

    <td id="row-${data['itemID']}-amount" class="itemamount">
           $${data['qty'] * data['price']}
    </td>

    <td>
    <form method="post" action="deleteCart.php">
        <input type="hidden" name="removeItemID" value="${data['itemID']}">
            <input type="submit" class="btn btn-sm btn-danger btn-block" value="REMOVE">
    </form>
    </td>
`;
        shoppingCartRow.innerHTML = htmlString.trim();
        var cart = document.querySelector('.shopping_cart>tbody');
        console.log(shoppingCartRow);
        cart.appendChild(shoppingCartRow);
    }
}