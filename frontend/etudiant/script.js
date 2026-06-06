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

const registerForm = document.getElementById("registerForm");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");
const passwordError = document.getElementById("passwordError");

if (registerForm && password && confirmPassword && passwordError) {
  registerForm.addEventListener("submit", function (event) {
    if (password.value !== confirmPassword.value) {
      event.preventDefault();

      passwordError.classList.remove("hidden");

      password.classList.add("border-red-500", "ring-2", "ring-red-500");
      confirmPassword.classList.add("border-red-500", "ring-2", "ring-red-500");
    } else {
      passwordError.classList.add("hidden");

      password.classList.remove("border-red-500", "ring-2", "ring-red-500");
      confirmPassword.classList.remove("border-red-500", "ring-2", "ring-red-500");
    }
  });
}
