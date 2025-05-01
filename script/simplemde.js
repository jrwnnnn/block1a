const simplemde = new SimpleMDE({
  element: document.getElementById("editor"),
  spellChecker: true,
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
