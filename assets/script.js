// will use later to determine current page
var current_path = 'home.php';

function checklogin(e, form) {
    e.preventDefault();

    $.post('login_auth.php', $(form).serialize(), function(resp) {

        // if success, reload the page since the session is now set
        if ( resp === 'success' )
            location.reload();
        else
            alert(resp);
    });
}

function loadPath(e, path) {

    // prevent #path from appending to the url
    e.preventDefault();

    // update the current page
    current_path = path;

    getPath(path);
}

function getPath(path) {
    $.get('./partials/' + path, function(resp) {
        //$('#app).html(resp) cause memory leak
        document.getElementById('app').innerHTML = resp;
    }).catch(function() {
        alert('error: partial/' + path + ' not found');
    });
}

function sendMessage(e, form) {

    e.preventDefault();

    $.post('partials/add_message.php', $(form).serialize(), function(resp) {
        $('#xhr_message').html(resp);
    });
}

function addUser(e, form) {
    e.preventDefault();

    $.post('partials/add_user.php', $(form).serialize(), function(resp) {
        $('#xhr_message').html(resp);
    });
}

// use in timer to automatically reload the home page
function refreshRecent() {
    console.log('refreshing');
    // reload the index page only if were are on the homepage
    if ( current_path === 'home.php' )
        getPath('home.php');
    else
        console.log('path is not home');
}

function toggleOption(e, input) {
    var state = input.checked,
        options = $('#recipient')[0].options;

    for (var i = 0; i < options.length; i++) {
        options[i].selected = state;
    }

}

document.addEventListener('DOMContentLoaded', function() {

    // attach the loadPath function to links already loaded, marked with .loadpath class
    document.querySelectorAll('a.loadpath')
        .forEach(function(nav) {
            nav.addEventListener('click', function(e) {

                // get link attribute and remove #
                var path = this.attributes.href.nodeValue.replace('#', '');

                // loadPath(event, element, url)
                // e     - default event that is pass to the handler
                // path  - custom string, ie: the partial page url
                loadPath(e, path);
            });
        });
});