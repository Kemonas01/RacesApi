function login()
{
    var logout = document.getElementById('logout');
    var user = document.getElementById('user');
    var image = document.getElementById('image')
    
        fetch('http://127.0.0.1:8000/api/user')
        .then(function(response) {
            if(response.ok){
                url = response.url
                if (url == "http://127.0.0.1:8000/login"){
                    image.innerHTML = "<a href='http://127.0.0.1:8000/login'><i class='material-icons'>lock</i></a>"
                }
                else {
                    getAvatar()
                    response.json().then(function(data){
                        user.innerHTML = data.login
                        logout.innerHTML = "<a href='http://127.0.0.1:8000/logout'>logout</a>"
                    });
                }
                
            }
            else {
                console.log('Mauvaise réponse du réseau');
        }
    })
}

function getAvatar(){
    var login = document.getElementById('image');

    fetch('http://127.0.0.1:8000/api/user/avatar')
        .then(function(response) {
            response.blob().then(function(data){
                var urlCreator = window.URL || window.webkitURL;
                var imageUrl = urlCreator.createObjectURL(data);
                login.innerHTML = "<img src='"+imageUrl+"'></href>"
            });
        })
}
login()

function hidden(){
    var hover = document.getElementById('hover');
    var test = document.getElementsByClassName('align');
    hover.onmouseover = function (){
        test[0].style.visibility='visible';
        test[1].style.visibility='visible';
    }
    hover.onmouseout = function (){
        test[0].style.visibility='hidden';
        test[1].style.visibility='hidden';
    }
    
}
hidden()
