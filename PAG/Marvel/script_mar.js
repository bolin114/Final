const marvel = {
  render: () => {
    // 11ad467c7893fe25c0ac25f60c0c43bccff8522e4609a850adf352ae0e341a0276048017f
    const urlAPI = 'https://gateway.marvel.com:443/v1/public/characters?ts=1&apikey=609a850adf352ae0e341a0276048017f&hash=a8398783553f7cc80d653dfd397c5df6'; //en la pagina de marvel se consigue el key para mostrar las imagenes, posteriormente con un generador de dm5 se copia el key privado y despues el publico, agregando un 1 al inicio del key, y despues e pega en el generador, despues se pega el dm5 al final del url, agregando &hash= dm5 
    const container = document.querySelector('#marvel-row');
    let contentHTML = '';
  
    fetch(urlAPI)
      .then(res => res.json())
      .then((json) => {
        for (const hero of json.data.results) {
          let urlHero = hero.urls[0].url;
          contentHTML += `
            <div class="col-md-4">
              <a href="${urlHero}" target="_blank">
                <img src="${hero.thumbnail.path}.${hero.thumbnail.extension}" alt="${hero.name}" class="img-thumbnail">
              </a>
              <h3 class="title">${hero.name}</h3>
            </div>`;
        }
        container.innerHTML = contentHTML;
      })
  }
};
marvel.render();