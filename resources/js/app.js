import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var channel = Echo.private('App.Models.User.'+id);
channel.notification(function(data) {
    console.log(data);
    alert(data.head);
});
