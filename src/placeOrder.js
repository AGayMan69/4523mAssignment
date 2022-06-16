async function updateQuantity(id, input) {
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
    console.log(output);
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
    console.log(output);
    // checking cartRow exist
    var cartRow = `itemRow${data['itemID']}`;
    var cartRowClass = `tr.${cartRow}`;
    if (document.querySelector(cartRowClass) === null) {
        // adding innerhtml
        var shoppingCartRow = document.createElement('tr');
        shoppingCartRow.classList.add(cartRow);
        const htmlString = `
    </td class="itemRow${data['itemID']}">
        ${data['itemName']} 
    <td>
        <input type="hidden" name="itemID" value="${data['itemID']}">
            <input type="number" class="itemqty" name="qty" min="1" max="${data['stockQuantity']}" value="${data['qty']}"
            onchange="updateQuantity(${data['itemID']},this)">
    </td>

    <td>$${data['price']}
        <input type="hidden" class="itemprice" value="${data['price']}">
    </td>

    <td class="itemamount">
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
        cart.appendChild(shoppingCartRow);
    }
}