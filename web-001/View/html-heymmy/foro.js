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
  
  });
  