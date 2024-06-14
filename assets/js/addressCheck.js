var request;
var timer = 0;
var requestSended = true;

const input = document.getElementById("jardinLocation");
const propositions = document.getElementById("propositionsAdresses");

function addressCheck(text) {
    if(input.value) propositions.innerHTML = "...";
    
    encodeURI(text);
    

    if(!input.value){
        propositions.innerHTML = "";
        return;
    }

    // fetch(`https://api.geoapify.com/v1/geocode/autocomplete?text=${text}&type=amenity&format=json&apiKey=2400638efdf346ff80e7e73a9c362be2&filter=countrycode:fr&bias=proximity:4.08333,48.299999`)
    request = `https://api.geoapify.com/v1/geocode/autocomplete?text=${text}&type=amenity&format=json&apiKey=b8568cb9afc64fad861a69edbddb2658&filter=countrycode:fr&bias=proximity:4.08333,48.299999`;

    resetTimer();

    
}

function sendRequest(){
    fetch(request)
        .then(response => response.json())
        .then(result => {
            console.log(result)
            var propositionsAdresses = "";
            if (typeof result.results !== 'undefined') {
                result.results.forEach(element => {
                    console.log(element);
                    propositionsAdresses += `<p onclick="updateAddressInput('${element.formatted}')">${element.formatted}</p>`;
                });
            }

            if(input.value) propositions.innerHTML = propositionsAdresses;
        })
        .catch(error => console.log('error', error));

        if(input.value) propositions.innerHTML = "...";
    requestSended = true;
}

function updateAddressInput(text){
    input.value = text;
    propositions.innerHTML = "";
}


function resetTimer(){
    timer = 500;
    requestSended = false;
}

function timerClock(){
    if(timer > 0) timer = timer - 50;

    if(requestSended === false && timer == 0) sendRequest();

    setTimeout(() => {
        timerClock();
    }, 50);
}
timerClock();