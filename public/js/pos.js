import { url_base } from "./config.js";

var products_json = {};
var car_list = {};

var total = 0;

const showError = (error) => {
    const modalBtn = document.querySelector('[data-modalBtn]');
    const modalMess = document.querySelector('[data-modalMessage]');
    
    console.log(error);
    modalMess.innerText = error
    modalBtn.click();
};

const sendSale = () => {
    const client_id = document.querySelector('[data-clientId]'); 
    const data = {
        client_id: client_id.value,
        total,
        products: car_list,
    };

    const url = url_base + 'sale';

    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    };

    fetch(url, options)
  .then(response => {
      if (response.ok) {
          console.log('OK');
          window.location.href = url_base + 'sale';
          return response.json();
      } else {
          console.log(response);
          throw new Error('Debe seleccionar al menos un producto y un cliente');
      }
  })
  .then(data => console.log(data))
  .catch(error => {
    console.error('Error:', error);
    showError(error);
    

});


};

window.addEventListener('DOMContentLoaded', () => {
    // Muestra todos los productos usando la categoria 0
    getProducts(0);

    const submitButton = document.querySelector('[data-submitButton]');
    
    submitButton.addEventListener('click', () => {
        sendSale();
    })
    
    var showMenu = document.querySelectorAll('[data-showMenu]');
    showMenu.forEach(( button ) => {
        button.addEventListener('click',() => {
            let carMenu = document.querySelectorAll('[data-carMenu]');
            carMenu.forEach( (Menu) => {
                Menu.classList.toggle('hidden');
            });           
        });
    });
    
});

const downAdded = ( product_id ) => {
    if(car_list[product_id].added > 0){
        car_list[product_id].added -= 1;
        updateProductsList();
    }
};

const UpAdded = ( product_id ) => {
    let product = null;
    products_json.forEach( (product_data ) => {
        if(product_data.id == product_id){
            product = product_data;
        }
    })
    if(car_list[product_id].added < product.stock){
        car_list[product_id].added += 1;
        updateProductsList();
    }
};

const deleteProduct = ( product_id ) => {
    console.log(car_list);
    delete car_list[product_id];
    console.log(car_list);
    updateProductsList();
};

const updateProductsList = () => {
    let body_products_list = document.querySelector('[data-productsList]');
    total = 0;
    const total_lable = document.querySelector('[data-total]');
    const subTotal_lable = document.querySelector('[data-subTotal]');
    const iva_lable = document.querySelector('[data-iva]');
    total_lable.innerText = '$ 0.00';
    subTotal_lable.innerText = '$ 0.00';
    iva_lable.innerText = '$ 0.00';
    
    body_products_list.innerHTML = '';
    
    for (const key in car_list) {
        const product = car_list[key];
        const product_item = document.createElement('li');
        product_item.className = 'flex py-6';
        product_item.innerHTML = `
        <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
            <img src="${url_base}uploads/${product.picture}" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="h-full w-full object-cover object-center">
        </div>

        <div class="ml-4 flex flex-1 flex-col">
          <div>
            <div class="flex justify-between text-base font-medium text-gray-900">
              <h3>
                <a href="#">${product.name}</a>
              </h3>
              <p class="ml-4">$${product.sale_price}</p>
            </div>
            
          </div>
          <div class="flex flex-1 items-end justify-between text-sm">
          <div class="flex flex-col justify-center items-center ">
            <p class="text-gray-500 ">Cantidad</p>
            <div class="flex justify-between">
            <button
                data-buttonDown="${product.id}"
                type="button"
                class="inline-block mr-2 w-1 rounded border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                data-te-ripple-init>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                </svg>

              
            </button>
                <p class="text-gray-500 mx-4 block">${product.added}</p>
                <button
                    data-buttonUp="${product.id}"
                    type="button"
                    class="inline-block ml-2 w-1 rounded border-2 border-primary px-6 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-primary-600 focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                    data-te-ripple-init>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                    </svg>
                </button>
            </div>
            
        </div>
            <div class="flex">
                <button 
                data-deleteProduct="${product.id}" type="button" class="font-medium text-red-600 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>

                </button>
            </div>
          </div>
        </div>
        `;

        // Añadiendo Listeners para los botones de aumentar y disminuir cantidad y eliminar
        body_products_list.appendChild(product_item);
        const buttonDown = document.querySelector(`[data-buttonDown="${product.id}"]`);
        const buttonUp = document.querySelector(`[data-buttonUp="${product.id}"]`);

        buttonDown.addEventListener('click', () => downAdded(buttonDown.getAttribute('data-buttonDown')));
        buttonUp.addEventListener('click', () => UpAdded(buttonUp.getAttribute('data-buttonUp')));
        
        const buttonDelete = document.querySelector(`[data-deleteProduct="${product.id}"]`);

        buttonDelete.addEventListener('click', () => deleteProduct(buttonDelete.getAttribute('data-deleteProduct')));
    
        // Calculado y mostrando totals
        total += product.sale_price * product.added;
        
        total_lable.innerText = '$' + (total).toFixed(2);

        subTotal_lable.innerText = '$' + (total * .84).toFixed(2);

        iva_lable.innerText = '$' + (total * .16).toFixed(2);

    }
};

const addProduct = ( product_id ) => {
    let product = null;
    products_json.forEach( (product_data ) => {
        if(product_data.id == product_id){
            product = product_data;
        }
    });
    if( !(product_id in car_list) ){
        if(product.stock > 0){
            product.added = 1;
            car_list[product_id] = product;
            updateProductsList();
        }
    }else{
        if(product.stock > car_list[product_id].added){
            car_list[product_id].added += 1;
            updateProductsList();
        }
        
    }
    
    
};

const showProducts = (products) => {
    // Obteniendo el cuerpo de la lista de productos
    const products_body = document.querySelector('[data-products]');
    products_body.innerHTML = '';
    // Convirtiendo a un objeto JS
    try {
        products_json = JSON.parse(products); // Analiza el JSON en un objeto JavaScript
        
    } catch (error) {
        console.error('Error parsing JSON:', error);
    }
    
    
    // Mostrando cada producto
    products_json.forEach( ( product ) => {
        if(product.stock > 0){
            let product_card = document.createElement('a');
            product_card.className = "aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-transparent xl:aspect-h-8 xl:aspect-w-7 cursor-pointer";
            //product_card.setAttribute('data-te-animation-init', '');
            //product_card.setAttribute('data-te-animation-target', '#animate-click');
            
            product_card.setAttribute('data-te-ripple-init', '');
            product_card.setAttribute('data-te-ripple-color', 'light');        
            product_card.innerHTML = `
            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                <div class="flex justify-center items-center " >
                <img src="${url_base}uploads/${product.picture}" class="w-full h-full rounded object-cover object-center group-hover:opacity-75">
                </div>
                </div>
                <h3 class="mt-4 ml-3 text-sm text-gray-700 dark:text-white" >${product.name}</h3>
            <p class="mt-1 ml-3 text-lg font-medium text-gray-900 dark:text-white">$ ${product.sale_price}</p>
            `;
            products_body.appendChild(product_card);
            product_card.addEventListener('click', () => {
                addProduct(product.id);
            })
        }
    });

    

    
}

const getProducts = ( category_id ) => {
    const data = {
        category_id
    };

    const url = url_base + 'sale/getProducts';
    
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    };

    fetch(url, options)
    .then(response => response.json())
    .then(data => showProducts(data))
    .catch(error => {
        console.error('Error:', error);
    })

};

const categories = document.querySelectorAll('[data-categoryId]');

categories.forEach( (category) => {
    category.addEventListener('click', () => {
        getProducts(category.getAttribute('data-categoryId'));
    });
});
