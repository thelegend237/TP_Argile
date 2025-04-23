// code.js

// Récupération des éléments HTML
const buttons = document.querySelectorAll("button");
const display = document.querySelector(".display");

// Initialisation de l'expression
let expression = "";

// Fonction pour mettre à jour l'affichage
function updateDisplay() {
  display.value = expression;
}

// Fonction pour évaluer l'expression
function evaluateExpression() {
  try {
    expression = eval(expression).toString();
  } catch (error) {
    expression = "Erreur";
  }
  updateDisplay();
}

// Ajout des événements sur les boutons
buttons.forEach(button => {
  button.addEventListener("click", () => {
    const value = button.dataset.value;

    if (value === "C") {
      expression = "";
    } else if (value === "=") {
      evaluateExpression();
      return;
    } else {
      expression += value;
    }

    updateDisplay();
  });
});
