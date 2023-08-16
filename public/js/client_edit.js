// Función para quitar acentos de una cadena
function quitarAcentos(str) {
  const acentos = {
    'á': 'a', 'é': 'e', 'í': 'i', 'ó': 'o', 'ú': 'u',
    'Á': 'A', 'É': 'E', 'Í': 'I', 'Ó': 'O', 'Ú': 'U',
    'ñ': 'n', 'Ñ': 'N'
    // Agrega aquí más caracteres acentuados y sus equivalentes sin acento si es necesario
  };

  return str.replace(/[áéíóúÁÉÍÓÚñÑ]/g, caracter => acentos[caracter] || caracter);
}

// Función para mostrar las ciudades en un select
const showCities = (cities) => {
  const selectCity = document.querySelector('[data-ciudadselect]');
  const selected = quitarAcentos(selectCity.getAttribute('data-ciudadselect'));

  selectCity.innerHTML = '';

  cities.forEach((city, index) => {
    selectCity.innerHTML += `
    <option value="${city.city_name}" ${city.city_name == selected ? 'selected' : ''}>
        ${city.city_name}
    </option>
    `;
  });
};

// Función para obtener las ciudades
const getCities = (cities) => {
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

// Función para mostrar los estados en un select
const showStates = (states) => {
  const selectState = document.querySelector('[data-estadoselect]');
  const selected = quitarAcentos(selectState.getAttribute('data-estadoselect'));

  selectState.innerHTML = '';

  states.forEach((state, index) => {
    selectState.innerHTML += `
    <option value="${state.state_name}" ${state.state_name == selected ? 'selected' : ''}>
        ${state.state_name}
    </option>`
  });

  selectState.addEventListener('change', () => {
    getCities(selectState.value);
  });
  getCities(document.querySelector('[data-estadoselect]').value);
};

// Función para obtener los estados
const getStates = (country) => {
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

// Función para mostrar los países en un select
const showCountry = (countries) => {
  const selectCountry = document.querySelector('[data-paisselect]');
  const selected = quitarAcentos(selectCountry.getAttribute('data-paisselect'));
  
  countries.forEach((country, index) => {
    selectCountry.innerHTML += `
    <option value="${country.country_name}" ${country.country_name == selected ? 'selected' : ''}>
        ${country.country_name}
    </option>`
  });

  selectCountry.addEventListener('change', () => {
    getStates(selectCountry.value);
  });

  getStates(document.querySelector('[data-paisselect]').value)
}

// Evento al cargar la página
window.addEventListener('DOMContentLoaded', () => {
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
