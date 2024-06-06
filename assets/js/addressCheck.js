function addressCheck(text) {
    encodeURI(text);
    input = document.getElementById("jardinLocation");
    propositions = document.getElementById("propositionsAdresses");

    if(!input.value){
        propositions.innerHTML = "";
        return;
    }

    fetch(`https://api.geoapify.com/v1/geocode/autocomplete?text=${text}&type=amenity&format=json&apiKey=2400638efdf346ff80e7e73a9c362be2&filter=countrycode:fr&bias=proximity:4.08333,48.299999`)
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
}

function updateAddressInput(text){
    input = document.getElementById("jardinLocation");
    propositions = document.getElementById("propositionsAdresses");

    input.value = text;
    propositions.innerHTML = "";
}