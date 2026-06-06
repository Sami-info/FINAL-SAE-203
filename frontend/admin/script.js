document.addEventListener("DOMContentLoaded", function () {
  const main = document.querySelector("main");

  if (main) {
    main.style.opacity = "0";
    main.style.transform = "translateY(40px)";
    main.style.transition = "opacity 0.8s ease, transform 0.8s ease";

    window.addEventListener("load", function () {
      main.style.opacity = "1";
      main.style.transform = "translateY(0)";
    });
  }

  const passwordInput = document.getElementById("password");
  const togglePassword = document.getElementById("togglePassword");
  const eyeIcon = document.getElementById("eyeIcon");

  if (passwordInput && togglePassword && eyeIcon) {
    togglePassword.addEventListener("click", function () {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
      } else {
        passwordInput.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
      }
    });
  }

  const counters = document.querySelectorAll(".counter");

  counters.forEach(function (counter) {
    const target = Number(counter.dataset.target);
    let count = 0;
    const increment = Math.ceil(target / 100);

    const updateCounter = function () {
      count += increment;

      if (count < target) {
        counter.textContent = count;
        setTimeout(updateCounter, 20);
      } else {
        counter.textContent = target;
      }
    };

    updateCounter();
  });
});

const entrepriseCards = document.querySelectorAll(".entreprise-card");

entrepriseCards.forEach(function (card, index) {
  card.style.opacity = "0";
  card.style.transform = "translateY(35px) rotate(-1deg)";
  card.style.transition = "opacity 0.7s ease, transform 0.7s ease, box-shadow 0.3s ease";

  setTimeout(function () {
    card.style.opacity = "1";
    card.style.transform = "translateY(0) rotate(0)";
  }, 200 + index * 150);

  card.addEventListener("mouseenter", function () {
    card.style.transform = "scale(1.04)";
    card.style.boxShadow = "0 20px 35px rgba(0, 0, 0, 0.12)";
  });

  card.addEventListener("mouseleave", function () {
    card.style.transform = "scale(1)";
    card.style.boxShadow = "";
  });
});
