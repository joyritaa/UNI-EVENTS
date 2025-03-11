window.addEventListener('scroll', function() {
  const header = document.querySelector('header');
  if (window.scrollY > 50) {
      header.classList.add('scrolled');
  } else {
      header.classList.remove('scrolled');
  }
});

document.addEventListener("DOMContentLoaded", function () {
    
  // LOGIN FUNCTION
document.getElementById("loginForm").addEventListener("submit", function (e) {
      e.preventDefault();
      let formData = new FormData(this);

      fetch("login.php", {
          method: "POST",
          body: formData,
      })
      .then(response => response.text())
      .then(data => {
          alert(data);
          if (data.includes("Login successful")) {
              window.location.href = "organizers.html";
          }
      })
      .catch(error => console.error("Error:", error));
  });
});