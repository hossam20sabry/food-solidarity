import './bootstrap';

import Alpine from 'alpinejs';
import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css';

window.Alpine = Alpine;

Alpine.start();

var counter = document.getElementById('counter');

var channel = Echo.private('App.Models.User.'+id);
channel.notification(function(data) {
    const toastElement = document.querySelector('.toast');
    toastElement.children[0].children[0].src = `/home/img/${data.icon}`;
    toastElement.children[0].children[1].innerHTML = data.head;
    toastElement.children[0].children[2].innerHTML = data.created_at;
    toastElement.children[1].children[0].children[0].innerHTML = data.body;
    // toastElement.children[1].children[0].href = data.url;

    const toast = new bootstrap.Toast(toastElement);
    toast.show();
});



