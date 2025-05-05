function showLoading() {
    document.getElementById('loading-overlay').classList.remove('hidden');
  }
  
  function hideLoading() {
    document.getElementById('loading-overlay').classList.add('hidden');
  }
  
  // Optional: Automatically show on form submit
  document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
      form.addEventListener('submit', () => {
        showLoading();
      });
    });
  });

  showLoading();
fetch('some-url')
  .then(response => response.json())
  .finally(() => hideLoading());
