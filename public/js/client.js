const showCities = ( cities ) => {
    const selectCity = document.querySelector('[data-ciudadselect]');

    selectCity.innerHTML = '';

    cities.forEach( (city, index) => {
        selectCity.innerHTML += `
        <option value="${city.city_name}" ${index == 0 ? 'selected' : ''}>
            ${city.city_name}
        </option>
        `;
    });
};

const getCities = ( cities ) => {
    const url = 'https://www.universal-tutorial.com/api/cities/' + cities;

    const headers = new Headers();
    headers.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJrZXZpbmFsZTEyMzFAZ21haWwuY29tIiwiYXBpX3Rva2VuIjoiNWlCWFlhQWgwQVZiQjVxX3JvSjM5cDRtOHRucDN3Ui1mc3puRDFqbUVGcUZ3SVBzeHZMZldRd2NsV09hRUtFOEtwcyJ9LCJleHAiOjE2OTIyNTA1NjN9.-2_i3hs-SGIVfejSuHZ2RvEqylu9FBymbyAuoxX8GFk");
    headers.append("Accept", "application/json");
    
    const requestOptions = {
      method: "GET",
      headers: headers,
      redirect: "follow"
    };
    
    fetch(url, requestOptions)
      .then(response => response.json())
      .then(data => {
        showCities(data);
      })
      .catch(error => {
        console.error("Error:", error);
      });
};

const showStates = ( states ) => {
    const selectState = document.querySelector('[data-estadoselect]');

    selectState.innerHTML = '';

    states.forEach( (state, index) => {
        selectState.innerHTML += `
        <option value="${state.state_name}" ${index == 0 ? 'selected' : ''}>
            ${state.state_name}
        </option>`
    });

    selectState.addEventListener('change', () => {
        getCities(selectState.value);
    });
    getCities(document.querySelector('[data-estadoselect]').value);
};

const getStates = ( country ) => {
    const url = 'https://www.universal-tutorial.com/api/states/' + country;

    const headers = new Headers();
    headers.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJrZXZpbmFsZTEyMzFAZ21haWwuY29tIiwiYXBpX3Rva2VuIjoiNWlCWFlhQWgwQVZiQjVxX3JvSjM5cDRtOHRucDN3Ui1mc3puRDFqbUVGcUZ3SVBzeHZMZldRd2NsV09hRUtFOEtwcyJ9LCJleHAiOjE2OTIyNTA1NjN9.-2_i3hs-SGIVfejSuHZ2RvEqylu9FBymbyAuoxX8GFk");
    headers.append("Accept", "application/json");
    
    const requestOptions = {
      method: "GET",
      headers: headers,
      redirect: "follow"
    };
    
    fetch(url, requestOptions)
      .then(response => response.json())
      .then(data => {
        showStates(data);
      })
      .catch(error => {
        console.error("Error:", error);
      });
};

const showCountry = (countries) => {
    console.log(typeof countries)

    const selectCountry = document.querySelector('[data-paisselect]');
    countries.forEach( (country, index) => {
        selectCountry.innerHTML += `
        <option value="${country.country_name}" ${index == 0 ? 'selected' : ''}>
            ${country.country_name}
        </option>`
    });

    selectCountry.addEventListener('change', () => {
        getStates(selectCountry.value);
    });

    getStates(document.querySelector('[data-paisselect]').value)


}

window.addEventListener('DOMContentLoaded', () => {
    console.log('ads');

    const url = "https://www.universal-tutorial.com/api/countries/";

    const headers = new Headers();
    headers.append("Authorization", "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJrZXZpbmFsZTEyMzFAZ21haWwuY29tIiwiYXBpX3Rva2VuIjoiNWlCWFlhQWgwQVZiQjVxX3JvSjM5cDRtOHRucDN3Ui1mc3puRDFqbUVGcUZ3SVBzeHZMZldRd2NsV09hRUtFOEtwcyJ9LCJleHAiOjE2OTIyNTA1NjN9.-2_i3hs-SGIVfejSuHZ2RvEqylu9FBymbyAuoxX8GFk");
    headers.append("Accept", "application/json");
    
    const requestOptions = {
      method: "GET",
      headers: headers,
      redirect: "follow"
    };
    
    fetch(url, requestOptions)
      .then(response => response.json())
      .then(data => {
        showCountry(data);
        
      })
      .catch(error => {
        console.error("Error:", error);
      });
    




});