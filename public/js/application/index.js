function updateList(lien){
    let ul = document.querySelector(".listeRace")
    var tbody = document.getElementById('tbody');
    fetch('http://127.0.0.1:8000'+lien)
    .then(function(response) {
        if(response.ok){
            updatePaginationRevamp(lien)
            response.json().then(function(data){
                let member = data['hydra:member'];
                //ul.innerHTML =""
                tbody.innerHTML =""
                for(const value in member){
                    /*ul.innerHTML += "<li>"+member[value].id+" Name : "+
                    member[value].name+" commence le : "+
                    member[value].willStartAt+"</li>"*/
                    tbody.innerHTML += "<tr><td>"+
                    member[value].id+
                    "</td><td>"+
                    member[value].name+
                    "</td><td>"+
                    member[value].willStartAt+
                    "</td></tr>"
                }
            });
        }
        else {
            console.log('Mauvaise réponse du réseau');
    }
    
})
    .catch(function(error) {
        console.log('Il y a eu un problème avec l\'opération fetch: ' + error.message);
      });
    
}

function bootstrap()
{
    updateList('/api/races')
    document.querySelector('.rrr').onclick = function(event){
        event.preventDefault()
        setList('/api/races')
    };
    
}

function updatePaginationRevamp(url) {
    fetch(url)
        .then(function (response) {
            if (response.ok) {
                response.json().then( function (monJson) {
                    document.getElementById('previous').onclick = function (event) {
                        //if(document.getElementById("previous").classList.contains('disabled'))
                        if (!(monJson['hydra:view'].hasOwnProperty('hydra:previous')))
                            event.preventDefault();
                        else {
                            document.getElementById('tbody').innerHTML = "";
                            updateList(monJson['hydra:view']['hydra:previous']);
                        }
                    };
                    
                    document.getElementById('next').onclick = function (event) {
                        //if(document.getElementById("next").classList.contains('disabled'))
                        if (!(monJson['hydra:view'].hasOwnProperty('hydra:next')))
                            event.preventDefault();
                        else {
                            document.getElementById('tbody').innerHTML = "";
                            updateList(monJson['hydra:view']['hydra:next']);
                        }
                    };
                })
            }
        })
}

function setUrlParameters(url){
    let order = $('[name=order]').val()
    let isClosed = $('[name=isClosed]').val()
    let search = $('[name=search]').val()
    return url+"?order["+order+"]=asc&isClosed="+isClosed+"&name="+search
}

function setList(url){
    res = setUrlParameters(url)
    updateList(res)
}

bootstrap()