let isDirty = false;

simplemde.codemirror.on("change", () => {
  isDirty = true;
});

window.addEventListener("beforeunload", function (e) {
  if (isDirty) {
    e.preventDefault();
    e.returnValue = '';
  }
});

function slugify(text) {
  return text.toLowerCase()
             .replace(/[^a-z0-9\s-]/g, '')
             .replace(/\s+/g, '-')
             .replace(/-+/g, '-');
}

document.getElementById('postForm').addEventListener('submit', async (e) => {
  e.preventDefault();
  const title = document.getElementById('title').value.trim();
  const data = {
    id: slugify(title),
    title,
    subtitle: document.getElementById('subtitle').value.trim(),
    cover: document.getElementById('cover').value.trim(),
    tag: document.getElementById('tag').value,
    spotlight: document.getElementById('spotlight').checked,
    content: simplemde.value()
  };

  if (!simplemde.value().trim()) {
    alert("Content cannot be empty.");
    return;
  }

  const res = await fetch('../functions/create-article.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });

  const result = await res.text();
  alert(result);
  isDirty = false;
  window.location.href = '../index.php';
});

const coverInput = document.getElementById("cover");
const coverPreview = document.getElementById("coverPreview");

coverInput.addEventListener("input", () => {
    const url = coverInput.value.trim();
    if (url) {
        coverPreview.src = url;
        coverPreview.classList.remove("hidden");
    } else {
        coverPreview.src = "";
        coverPreview.classList.add("hidden");
    }
});