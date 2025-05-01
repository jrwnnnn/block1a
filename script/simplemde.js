const simplemde = new SimpleMDE({
  element: document.getElementById("editor"),
  spellChecker: false,
  autosave: {
    enabled: true,
    uniqueId: "blogEditor",
    delay: 1000,
  },
  toolbar: [
    "bold", "italic", "strikethrough", "heading", "|", 
    "quote", "code", "|", 
    "unordered-list", "ordered-list", "clean-block", "|",
    "link", "image", "table", "|", 
    "preview"
  ],
  status: false,
  previewRender: function(plainText) {
    return SimpleMDE.prototype.markdown(plainText);
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

  const res = await fetch('../functions/save-article.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  });

  if (!simplemde.value().trim()) {
    alert("Content cannot be empty.");
    return;
  }

  const result = await res.text();
  alert(result);
});