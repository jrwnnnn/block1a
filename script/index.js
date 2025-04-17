function copyToClipboard() {
    const text = "cs1a.minecra.fr";
    document.getElementById("copy-button").innerHTML = "Copied!";
    navigator.clipboard.writeText(text);
  }

  fetch('https://api.mcsrvstat.us/2/invadedlands.net')
  .then(response => response.json())
  .then(data => {
    document.getElementById('player-count').innerText = data.players.online;
  });

  const toggle = document.getElementById('menu-toggle');
  const links = document.getElementById('nav-links');

  toggle.addEventListener('click', () => {
    links.classList.toggle('hidden');
    links.classList.toggle('flex');
    links.classList.toggle('flex-col');
    links.classList.toggle('animate-slide');
  });

  const carousel = document.getElementById('carousel');
    const total = carousel.children.length;
    let index = 0;

    function updateSlide() {
      carousel.style.transform = `translateX(-${index * 100}%)`;
    }

    function nextSlide() {
      index = (index + 1) % total;
      updateSlide();
    }

    setInterval(nextSlide, 4000); 