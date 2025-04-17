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