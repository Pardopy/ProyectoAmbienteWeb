document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('registerForm');
  
  form.addEventListener('submit', function(event) {
      event.preventDefault(); // Evitar el envío del formulario

      // Obtener datos del formulario
      const nombre = document.getElementById('nombre').value;
      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;
      const tipoUsuario = document.getElementById('tipoUsuario').value; // Obtener el valor del selector

      // Obtener datos guardados en localStorage
      let usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];

      // Añadir el nuevo usuario
      usuarios.push({
          nombre: nombre,
          email: email,
          password: password,
          tipoUsuario: tipoUsuario // Agregar el tipo de usuario
      });

      // Guardar datos en localStorage
      localStorage.setItem('usuarios', JSON.stringify(usuarios));

      // Redirigir a index.html
      window.location.href = 'index.html';
  });
});
