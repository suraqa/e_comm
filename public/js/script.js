$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const update = (quantityElement, id) => {
    const priceElement = document.querySelector(`#price-${id}`);
    const subtotalElement = document.querySelector(`#subtotal-${id}`);
    subtotalElement.innerHTML = priceElement.innerHTML * quantityElement.value

    $.ajax({
        url: "/update-quantity",
        data: {
            "product_id": id,
            "quantity": quantityElement.value
        },
        type: 'put'
    });
}

const cartDelete = id => {
    $.ajax({
        url: "/delete-item",
        data: {
            "product_id": id
        },
        type: 'delete',
        success: response => {
            console.log(response)
        }
    });

    $("#table").load(" #table");
}

