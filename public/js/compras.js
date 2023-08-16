
buttonAddProduct = document.querySelector('[data-addProduct]');

form = document.querySelector('[data-form]');

var products_list = [];
var total = 0;

const updateSumary = () => {
    total = 0;
    products_list.forEach( (item) => {
        total += parseFloat(item.element.purchase_price) * parseInt(item.stock); 
    });

    subtotal = document.querySelector('[data-subtotal]');
    iva = document.querySelector('[data-iva]');
    total_l = document.querySelector('[data-total]');

    subtotal.innerText = (total * .84).toFixed(2);
    iva.innerText = (total * .16).toFixed(2);
    total_l.innerText = (total).toFixed(2);

    console.log(subtotal);
    console.log(iva);
    console.log(total_l);

}

const DOOMModify = (data) => {
    const element = data.product;
    let stock = data.stock;
    let purchase_price = data.purchase_price;
    let finde = false;
    products_list.forEach(( e ) => {
        if( e.element.id ==  element.id){
            e.stock = parseInt(e.stock) + parseInt(stock);
            e.purchase_price = purchase_price;
            finde = true    
        }
    })

    if(!finde){
        products_list.push(
            {element,
            stock,
            purchase_price,
            }
        );
    }
    updateSumary();

    console.log(products_list);
    console.log('total:', total);


    
    let table_body = document.querySelector('[data-tableItems]');
    table_body.innerHTML = "";
    products_list.forEach( (item,index) => {
        tr = document.createElement('tr');
        tr.setAttribute('data-ProductId', item.element.id);
        tr.classList.add('border-b', 'dark:border-neutral-500');
        

        td_name = document.createElement('td');
        td_name.classList.add('whitespace-nowrap', 'px-6', 'py-4', 'font-medium');
        tr.appendChild(td_name);
        image = document.createElement('img');
        image.classList = "w-24 inline mr-5";
        image.src = 'http://localhost/uploads/' + item.element.picture;
        td_name.appendChild(image);
        lable_name = document.createElement('label');
        lable_name.innerText = item.element.name;
        lable_name.classList.add('w-16', 'text-center', 'bg-transparent');
        td_name.appendChild(lable_name);
        input_name = document.createElement('input');
        input_name.readOnly = true;
        input_name.hidden = true;
        input_name.name = "product_id_" + item.element.id;
        input_name.value = item.element.id;
        td_name.appendChild(input_name);

        td_stock = document.createElement('td');
        td_stock.classList.add('whitespace-nowrap', 'px-6', 'py-4', 'font-medium');
        tr.appendChild(td_stock);
        down_button = document.createElement('button');
        down_button.type = "button"
        down_button.classList = 'inline-block rounded-full bg-primary w-8 h-8 text-xs font-medium uppercase leading-normal text-white shadow-[0 4px 9px -4px #3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] dark:shadow-[0 4px 9px -4px rgba(59,113,202,0.5)] dark:hover:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)] dark:focus:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)] dark:active:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)]';
        down_button.innerText = "-";
        down_button.setAttribute('data-stockButton',`${item.element.id}`)
        td_stock.appendChild(down_button);
        input_stock = document.createElement('input');
        input_stock.value = item.stock;
        input_stock.classList.add('w-16', 'text-center', 'bg-transparent');
        input_stock.readOnly = true;
        input_stock.name = "product_id_stock_" + item.element.id;
        input_stock.value = item.stock;
        input_stock.setAttribute('data-stockProductId',item.element.id);
        input_stock.setAttribute('data-productIndex', index);
        input_stock.setAttribute
        td_stock.appendChild(input_stock);
        up_button = document.createElement('button');
        up_button.type = "button"
        up_button.classList = 'inline-block rounded-full bg-primary w-8 h-8 text-xs font-medium uppercase leading-normal text-white shadow-[0 4px 9px -4px #3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] dark:shadow-[0 4px 9px -4px rgba(59,113,202,0.5)] dark:hover:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)] dark:focus:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)] dark:active:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)]';
        up_button.innerText = "+";
        up_button.setAttribute('data-stockButton',`${item.element.id}`)
        td_stock.appendChild(up_button);

        up_button.addEventListener('click', ( e ) => {
            product_id = e.target.dataset.stockbutton;

            input_product_id_stock = document.querySelector(`[data-stockproductid="${product_id}"]`);

            index = input_product_id_stock.dataset.productindex;

            input_product_id_stock.value = parseInt(products_list[index].stock) + 1;
            products_list[index].stock = parseInt(products_list[index].stock) + 1; 
            updateSumary();
            console.log(products_list);
        });

        down_button.addEventListener('click', ( e ) => {
            product_id = e.target.dataset.stockbutton;
            
            input_product_id_stock = document.querySelector(`[data-stockproductid="${product_id}"]`);

            index = input_product_id_stock.dataset.productindex;

            if(products_list[index].stock > 0){
                input_product_id_stock.value = products_list[index].stock - 1;
                products_list[index].stock = products_list[index].stock - 1;
                updateSumary();
    
            }
            console.log(total);
            console.log(products_list);
        });

        td_purchase = document.createElement('td');
        td_purchase.classList.add('whitespace-nowrap', 'px-6', 'py-4', 'font-medium');
        tr.appendChild(td_purchase);
        input_purchase = document.createElement('input');
        input_purchase.value = item.purchase_price;
        input_purchase.readOnly = true;
        input_purchase.classList.add('w-16', 'text-center', 'bg-transparent');
        td_purchase.appendChild(input_purchase);

        td_sale = document.createElement('td');
        td_sale.classList.add('whitespace-nowrap', 'px-6', 'py-4', 'font-medium');
        tr.appendChild(td_sale);
        input_sale = document.createElement('input');
        input_sale.value = item.element.sale_price;
        input_sale.readOnly = true;
        input_sale.classList.add('w-16', 'text-center', 'bg-transparent');
        td_sale.appendChild(input_sale);

        td_sale = document.createElement('td');
        td_sale.classList.add('whitespace-nowrap', 'px-6', 'py-4', 'font-medium');
        tr.appendChild(td_sale);
        button = document.createElement('button');
        button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>'
        td_sale.appendChild(button);
        button.type = 'button';
        button.setAttribute('data-delProductId', item.element.id);

        button.addEventListener('click', function() {
            const delProductId = this.getAttribute('data-delProductId');
            delItem = document.querySelector(`[data-Productid="${delProductId}"]`);
            delItem.remove();
            
            products_list.splice(index,1);

            updateSumary();
        });
        


        table_body.appendChild(tr);
    } );



}

const addProduct = () => {
    product_id = document.querySelector('[data-product').value;
    stock_product = document.querySelector('[data-stock]').value;
    purchase_price = document.querySelector('[data-purchase_price]').value;
    
    if(stock_product == ''){
        return 1; 

    }

    const data = {
        product_id,
        stock_product,
        purchase_price,
    };

    const url = 'http://localhost/purchase/addproduct';

    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body:JSON.stringify(data)
    };

    fetch(url, options)
    .then(response => response.json()) // Procesa la respuesta como JSON
    .then(data => DOOMModify(data))
    .catch(error => {
      console.error('Error:', error);
    });
}

const showError = () => {
    error = document.querySelector('[data-error]');

    error_message = document.createElement('p');
    error_message.innerText = 'Algo salio mal, intente nuevamente y verifique que todos los campos esten llenos';
    error.appendChild(error_message);
}

const sendForm = (e) => {
    e.preventDefault()

    provedor_id = document.querySelector('[data-provedorid]').value;
    date = document.querySelector('[data-date]').value;
    code = document.querySelector('[data-code]').value;
    


    const formDataObj = {
        provedor_id,
        date,
        code,
        total,
        products: {
            
        }

    };

    console.log(products_list);

    products_list.forEach( (compra) => {
        console.log(compra);
        formDataObj.products[compra.element.id] = compra.stock;
    });

    const jsonPayload = JSON.stringify(formDataObj);

    const url = 'http://localhost/purchase';

    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: jsonPayload
    };

    fetch(url, options)
  .then(response => {
    if (response.ok) {
        const div = document.querySelector('[data-error]');
        div.classList.add('hidden');
        console.log(products_list);
        window.location.href = 'http://localhost/purchase';
      return response.json(); // Retorna la promesa resultante de response.json()
      
    } else {
        const div = document.querySelector('[data-error]');
        div.classList.remove('hidden');
        div.innerHTML = `
        <p>Verifique que los campos esten llenos:</p>
        <ul class="flex justify-start flex-col items-start">
        `;
        response.json().then( (data) => {
            console.log(data);
            for (const key in data.errors) {
                if (data.errors.hasOwnProperty(key)) {
                  div.innerHTML += `<li class=>${data.errors[key][0]}</li>`;
                }
              }
              div.innerHTML = div.innerHTML + '</ul>';
        }    
        )
        

      throw new Error('Error en la solicitud');
    }
  })
  .then(data => {
    console.log('Respuesta exitosa:', data);
  })
  .catch(error => {
    console.log('error:', error);
  });


}


buttonAddProduct.addEventListener('click', addProduct);

form.addEventListener('submit', (e) => sendForm(e));

const showPurchasePrice = ( product ) => {
    inputPurchasePrice = document.querySelector('[data-purchase_price]');
    inputPurchasePrice.value = product.product.purchase_price;
};

const getProduct = (product_id) => {
    const data = {
        product_id,
        stock_product: 0,
    };

    const url = 'http://localhost/purchase/addproduct';

    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body:JSON.stringify(data)
    };

    fetch(url, options)
    .then(response => response.json()) // Procesa la respuesta como JSON
    .then(data => {
        showPurchasePrice(data);
    })
    .catch(error => {
      console.error('Error:', error);
    });
};



window.addEventListener('DOMContentLoaded', () => {
    selectProduct = document.querySelector('[data-product]');
    let product_id = selectProduct.value;

    getProduct(product_id);

    selectProduct.addEventListener('change', () => {
        product_id = selectProduct.value;
        getProduct(product_id);

    })
})