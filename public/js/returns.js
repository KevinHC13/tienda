import { url_base } from "./config.js";

var returns_list = {};

const updateQuantity = ( lable, product_id ) => {
    lable.innerText = '';
    lable.innerText = returns_list[product_id] ? returns_list[product_id].quantity : 0 ;

};

const downReturns = (product_id) => {
    const lableQuantity = document.querySelector(`[data-lableQuantity="${product_id}"]`);

    if( (product_id in returns_list) ){
        console.log(returns_list[product_id].quantity);
        if(returns_list[product_id].quantity > 1){
            returns_list[product_id].quantity -= 1;
        }else{
            delete returns_list[product_id];
        }

        updateQuantity(lableQuantity, product_id)
        console.log(returns_list);
    }
    
};

const upReturns = (product_id) => {
    const lableQuantity = document.querySelector(`[data-lableQuantity="${product_id}"]`);
    let quantity = lableQuantity.getAttribute('data-quantity');

    if( !(product_id in returns_list) ){
        returns_list[product_id] = {
            product_id,
            quantity: 1,
        };
    }else{
        if(quantity > returns_list[product_id].quantity){
            returns_list[product_id].quantity += 1;
        }
    }

    updateQuantity(lableQuantity, product_id)
    console.log(returns_list);
};


const showError = (error) => {
    const modalBtn = document.querySelector('[data-modalBtn]');
    const modalMess = document.querySelector('[data-modalMessage]');
    
    console.log(error);
    modalMess.innerText = error.message;
    modalBtn.click();
};


window.addEventListener('DOMContentLoaded', () => {
    const buttonsDown = document.querySelectorAll('[data-buttondown]');
    const buttonsUp = document.querySelectorAll('[data-buttonup]');

    const sendButton = document.querySelector('[data-sendbutton]');

    buttonsUp.forEach( (button) => {
        button.addEventListener('click', () => {
            upReturns(button.getAttribute('data-buttonup'));
        });
    });

    buttonsDown.forEach( (button) => {
        button.addEventListener('click', () => {
            downReturns(button.getAttribute('data-buttondown'));
        });
    });

    sendButton.addEventListener('click', () => {
        const sale_id = document.querySelector('[data-saleid]').getAttribute('data-saleid');

        const data = {
            sale_id,
            products: returns_list,
        };

        const url = url_base + 'returns';

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
                window.location.href = url_base + 'returns';
            } else {
                if (response.status === 422) {
                    console.log('Error 422 - Unprocessable Entity');
                    return response.json();
                } else {
                    throw new Error('Algo salio mal. Intente de nuevo mas tarde');
                }
            }
        })
        .then(data => {
            if (data) {
                showError(data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError(error);
        });


    });



    

    
});