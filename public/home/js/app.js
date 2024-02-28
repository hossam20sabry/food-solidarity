import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
console.log("hi from app.js");
var channel = Echo.private(`App.Models.User.${id}`);
channel.notification(function(data) {
    console.log(data);
    alert(data.body);
});
