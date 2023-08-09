buttonAddProduct = document.querySelector('[data-addProduct]');

form = document.querySelector('[data-form]');
console.log(form);

var products_list = [];

const DOOMModify = (data) => {
    const element = data.product;
    let stock = data.stock;
    let finde = false;
    products_list.forEach(( e ) => {
        if( e.element.id ==  element.id){
            e.stock = parseInt(e.stock) + parseInt(stock);
            finde = true    
        }
    })

    if(!finde){
        products_list.push(
            {element,
            stock,
            }
        );
    }


    console.log('Hola')


    
    let table_body = document.querySelector('[data-tableItems]');
    table_body.innerHTML = "";
    products_list.forEach( (item,index) => {
        console.log(item.element.name);
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
        td_stock.appendChild(down_button);
        input_stock = document.createElement('input');
        input_stock.value = item.stock;
        input_stock.classList.add('w-16', 'text-center', 'bg-transparent');
        input_stock.readOnly = true;
        input_stock.name = "product_id_stock_" + item.element.id;
        input_stock.value = item.stock;
        td_stock.appendChild(input_stock);
        up_button = document.createElement('button');
        up_button.type = "button"
        up_button.classList = 'inline-block rounded-full bg-primary w-8 h-8 text-xs font-medium uppercase leading-normal text-white shadow-[0 4px 9px -4px #3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0 8px 9px -4px rgba(59,113,202,0.3),0 4px 18px 0 rgba(59,113,202,0.2)] dark:shadow-[0 4px 9px -4px rgba(59,113,202,0.5)] dark:hover:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)] dark:focus:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)] dark:active:shadow-[0 8px 9px -4px rgba(59,113,202,0.2),0 4px 18px 0 rgba(59,113,202,0.1)]';
        up_button.innerText = "+";
        td_stock.appendChild(up_button);

        up_button.addEventListener('click', () => {
            input_stock.value = parseInt(products_list[index].stock) + 1;
            products_list[index].stock = parseInt(products_list[index].stock) + 1; 
        });

        down_button.addEventListener('click', () => {
            if(products_list[index].stock > 0){
                input_stock.value = products_list[index].stock - 1;
                products_list[index].stock = products_list[index].stock - 1; 
    
            }
        });

        td_purchase = document.createElement('td');
        td_purchase.classList.add('whitespace-nowrap', 'px-6', 'py-4', 'font-medium');
        tr.appendChild(td_purchase);
        input_purchase = document.createElement('input');
        input_purchase.value = item.element.purchase_price;
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
            console.log(products_list);
        });
        


        table_body.appendChild(tr);
    } );



}

const addProduct = () => {
    product_id = document.querySelector('[data-product').value;
    stock_product = document.querySelector('[data-stock]').value;
    
    const data = {
        product_id,
        stock_product,
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

const sendForm = (e) => {
    e.preventDefault()

    const formDataObj = {};

    products_list.forEach( ( item, i ) => {
        console.log(item.element.id);
        formDataObj[item.element.id] = item.stock
    } );

    console.log(formDataObj);

}


buttonAddProduct.addEventListener('click', addProduct);

form.addEventListener('click', (e) => sendForm(e));