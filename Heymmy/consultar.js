document.addEventListener('DOMContentLoaded', function() {
  // Obtener el cuerpo de la tabla
  const tableBody = document.getElementById('usuariosTableBody');
  
  // Obtener datos de localStorage
  const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];

  // Generar filas de la tabla
  usuarios.forEach(function(usuario) {
    const row = document.createElement('tr');
    row.innerHTML = `
      <td>${usuario.nombre}</td>
      <td>${usuario.email}</td>
      <td>${usuario.tipoUsuario}</td> <!-- Mostrar tipoUsuario -->
    `;
    tableBody.appendChild(row);
  });
});
