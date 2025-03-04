document.addEventListener("DOMContentLoaded", function () {
    const treneriSlike = document.querySelectorAll(".animacijaprva");

    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    observer.unobserve(entry.target); // Isključuje dalju posmatranje nakon prvog prikaza
                }
            });
        },
        { threshold: 0.01 } // Slika mora biti bar 50% vidljiva pre nego što se animacija aktivira
    );

    treneriSlike.forEach((slika) => {
        observer.observe(slika);
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const treneriSlike = document.querySelectorAll(".animacijaprva1");

    const observer = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    observer.unobserve(entry.target); // Isključuje dalju posmatranje nakon prvog prikaza
                }
            });
        },
        { threshold: 0.1 } // Slika mora biti bar 50% vidljiva pre nego što se animacija aktivira
    );

    treneriSlike.forEach((slika) => {
        observer.observe(slika);
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const treneriSlike = document.querySelectorAll(".karticatrener1");
  
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                }
            });
        },
        { threshold: 0.1 }
    );
  
    treneriSlike.forEach((slika) => {
        observer.observe(slika);
    });
  });

  document.querySelector('a[href="#kontakt"]').addEventListener("click", function(e) {
    e.preventDefault();
    document.querySelector("#kontakt").scrollIntoView({ behavior: "smooth" });
});


document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener("click", function(e) {
      e.preventDefault();
      
      let target = document.querySelector(this.getAttribute("href"));
      let offset = 60; // Podesi ovo prema visini navbara

      window.scrollTo({
          top: target.offsetTop - offset,
          behavior: "smooth"
      });
  });
});

function calculateBMI() {
    let weight = document.getElementById("weight").value;
    let height = document.getElementById("height").value / 100;
    let age = document.getElementById("age").value;
    let gender = document.getElementById("gender").value;
    
    if (weight > 0 && height > 0 && age > 0) {
        let bmi = (weight / (height * height)).toFixed(2);
        let category = "";
        
        if (bmi < 18.5) category = "Pothranjenost";
        else if (bmi < 24.9) category = "Normalna težina";
        else if (bmi < 29.9) category = "Prekomerna težina";
        else category = "Gojaznost";
        
        document.getElementById("result").innerHTML = `Vaš BMI: ${bmi} (${category}), Pol: ${gender}, Godine: ${age}`;
    } else {
        document.getElementById("result").innerHTML = "Molimo unesite ispravne vrednosti.";
    }
}












