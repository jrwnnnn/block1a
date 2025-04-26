let index = 0;
const chunkSize = 3;

function loadArticles() {
  const container = document.getElementById("article-section");
  const end = Math.min(index + chunkSize, articleData.length);

  for (; index < end; index++) {
    const a = articleData[index];

    const card = document.createElement("div");
    card.className = "hover:cursor-pointer";
    card.onclick = () => window.location.replace(`article.php?slug=${a.slug}`);

    card.innerHTML = `
      <img src="${a.cover}" alt="cover" class="mb-5 rounded-md">
      <p class="${a['tag-col']} text-md">${a.tag}</p>
      <p class="article-title">${a.title}</p>
      <p class="article-subtext">${a.subtitle}</p>
      <p class="text-gray-400 pt-5">${a.date}</p>
    `;

    container.appendChild(card);
  }

  if (index >= articleData.length) {
    document.getElementById("loadMore").style.display = "none";
  }
}

document.getElementById("loadMore").addEventListener("click", loadArticles);