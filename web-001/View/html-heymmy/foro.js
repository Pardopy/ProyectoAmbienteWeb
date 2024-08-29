document.addEventListener('DOMContentLoaded', function() {
    // Manejo de los botones de Like y Dislike
    document.querySelectorAll('.like-btn').forEach(button => {
      button.addEventListener('click', function() {
        const countSpan = this.querySelector('.like-count');
        countSpan.textContent = parseInt(countSpan.textContent) + 1;
      });
    });
  
    document.querySelectorAll('.dislike-btn').forEach(button => {
      button.addEventListener('click', function() {
        const countSpan = this.querySelector('.dislike-count');
        countSpan.textContent = parseInt(countSpan.textContent) + 1;
      });
    });
  
    // Manejo del formulario para crear nuevas publicaciones
    document.getElementById('nueva-publicacion-form').addEventListener('submit', function(event) {
      event.preventDefault();
      
      // Obtener los datos del formulario
      const titulo = document.getElementById('titulo').value;
      const contenido = document.getElementById('contenido').value;
  
      // Crear una nueva publicación
      const nuevaPublicacion = document.createElement('div');
      nuevaPublicacion.classList.add('publicacion');
      nuevaPublicacion.innerHTML = `
        <h3>${titulo}</h3>
        <p class="autor">Por Autor Desconocido</p>
        <p class="fecha">Publicado el ${new Date().toLocaleDateString()}</p>
        <p class="contenido">${contenido}</p>
        <button class="like-btn">👍 Like <span class="like-count">0</span></button>
        <button class="dislike-btn">👎 Dislike <span class="dislike-count">0</span></button>
      `;
  
      // Añadir la nueva publicación al contenedor de publicaciones
      document.getElementById('publicaciones').appendChild(nuevaPublicacion);
  
      // Restablecer el formulario
      this.reset();
  
      // Añadir funcionalidad a los nuevos botones de Like y Dislike
      nuevaPublicacion.querySelector('.like-btn').addEventListener('click', function() {
        const countSpan = this.querySelector('.like-count');
        countSpan.textContent = parseInt(countSpan.textContent) + 1;
      });
  
      nuevaPublicacion.querySelector('.dislike-btn').addEventListener('click', function() {
        const countSpan = this.querySelector('.dislike-count');
        countSpan.textContent = parseInt(countSpan.textContent) + 1;
      });
    });
  });
  