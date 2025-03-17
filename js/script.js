function calculateBMI() {
    let weight = document.getElementById("weight").value;
    let height = document.getElementById("height").value / 100;
    let age = document.getElementById("age").value;
    let gender = document.getElementById("gender").value;
    
    // Ispisivanje rezultata i ikone
    if (weight > 0 && height > 0 && age > 0) {
        let bmi = (weight / (height * height)).toFixed(2);
        let category = "";
        let icon = "";

        // Kategorije BMI-a i odgovarajuća ikonica
        if (bmi < 18.5) {
            category = "Pothranjenost";
            icon = `<img src="img/crvena.png" alt="Pothranjenost">`;  // Ikonica za pothranjenost
        } else if (bmi < 24.9) {
            category = "Normalna težina";
            icon = `<img src="img/zelena.png" alt="Normalna težina">`;  // Ikonica za normalnu težinu
        } else if (bmi < 29.9) {
            category = "Prekomerna težina";
            icon = `<img src="img/narandza.png" alt="Prekomerna težina">`;  // Ikonica za prekomernu težinu
        } else {
            category = "Gojaznost";
            icon = `<img src="img/crvena.png" alt="Gojaznost">`;  // Ikonica za gojaznost
        }
        
        // Prikazivanje rezultata i ikone
        document.getElementById("icon").innerHTML =icon;  // Prikazuje ikonu
        document.getElementById("result").innerHTML = `<div><span style="font-family: 'Inter';" class="bmi">${bmi}</span></div>  <div style="font-size:18px;font-family: 'Inter';">(${category})</div>`;
    } else {
        document.getElementById("result").innerHTML = "Molimo unesite ispravne vrednosti.";
        document.getElementById("icon").innerHTML = "";  // Uklanja ikonu ako nisu uneti validni podaci
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll('.animacija');
  
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    }, {
      threshold: 0.3 // Pokreće animaciju kad je 30% elementa u vidnom polju
    });
  
    elements.forEach((el) => observer.observe(el));
  });

  document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll('.animacija1');
  
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        }
      });
    }, {
      threshold: 0.00000000001 // Pokreće animaciju kad je 30% elementa u vidnom polju
    });
  
    elements.forEach((el) => observer.observe(el));
  });

  function calculateBMI() {
    let weight = document.getElementById("weight").value;
    let height = document.getElementById("height").value / 100;
    let age = document.getElementById("age").value;
    let gender = document.getElementById("gender").value;

    let result = document.getElementById("result");
    let icon = document.getElementById("icon");

    // Reset animacija
    result.classList.remove('show', 'animated');
    icon.classList.remove('show', 'animated');

    if (weight > 0 && height > 0 && age > 0) {
        let bmi = (weight / (height * height)).toFixed(2);
        let category = "";
        let iconHTML = "";

        if (bmi < 18.5) {
            category = "Pothranjenost";
            iconHTML = `<img src="img/crvena.png" alt="Pothranjenost">`;
        } else if (bmi < 24.9) {
            category = "Normalna težina";
            iconHTML = `<img src="img/zelena.png" alt="Normalna težina">`;
        } else if (bmi < 29.9) {
            category = "Prekomerna težina";
            iconHTML = `<img src="img/narandza.png" alt="Prekomerna težina">`;
        } else {
            category = "Gojaznost";
            iconHTML = `<img src="img/crvena.png" alt="Gojaznost">`;
        }

        // Postavljanje rezultata
        icon.innerHTML = iconHTML;
        result.innerHTML = `
            <div><span style="font-family: 'Inter';" class="bmi">${bmi}</span></div>  
            <div style="font-size:18px;font-family: 'Inter';">(${category})</div>
        `;

        // Timeout za ponovni start animacije
        setTimeout(() => {
            icon.classList.add('show', 'animated');
            result.classList.add('show', 'animated');
        }, 50);

    } else {
        result.innerHTML = "Molimo unesite ispravne vrednosti.";
        icon.innerHTML = "";
    }
}

function playVideo() {
  const videoContainer = document.getElementById('videoContainer');
  videoContainer.innerHTML = `
      <iframe class="video2"  src="https://www.youtube.com/embed/vsA8T2_9v04?autoplay=1&rel=0&modestbranding=1" 
          title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
          allowfullscreen>
      </iframe>
  `;
}



document.addEventListener('DOMContentLoaded', function() {
  const bars = document.querySelectorAll('.linije2');

  // Intersection Observer setup
  const options = {
    root: null, // posmatra viewport
    threshold: 0.5, // 50% elementa mora biti vidljivo da bi se aktiviralo
  };

  const fillBar = (entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.width = entry.target.style.getPropertyValue('--target-width');
        observer.unobserve(entry.target); // skida observer nakon animacije
      }
    });
  };

  const observer = new IntersectionObserver(fillBar, options);

  bars.forEach(bar => {
    observer.observe(bar);
  });
});
