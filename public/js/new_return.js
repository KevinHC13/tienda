import { url_base } from "./config.js";

window.addEventListener('DOMContentLoaded', () => {
    const sendBtn = document.querySelector('[data-sendButton]');
    
    sendBtn.addEventListener('click', () => {
        const sale_id = document.querySelector('[data-saleid]');
        console.log(sale_id.value)
        window.location.href = url_base + 'returns/create/' + sale_id.value;
    })
})