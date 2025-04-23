// code.js

// Récupération des éléments HTML
const buttons = document.querySelectorAll("button");
const display = document.getElementById("box");

// Initialisation de l'expression
let expression = "";

// Fonction pour mettre à jour l'affichage
function updateDisplay() {
  display.textContent = expression || "zéro";
}

// Fonction pour évaluer l'expression
function evaluateExpression() {
  try {
    const result = Function(`'use strict'; return (${expression})`)();
    expression = result.toString();
  } catch (error) {
    expression = "Erreur";
  }
  updateDisplay();
}

// Fonction pour ajouter un nombre ou un opérateur
function handleInput(value) {
  switch(value) {
    case "C":
      expression = "";
      break;
    case "CE":
      expression = expression.slice(0, -1);
      break;
    case "Backspace":
      expression = expression.slice(0, -1);
      break;
    case "%":
      if (expression) {
        expression = (parseFloat(expression) / 100).toString();
      }
      break;
    case "plus_minus":
      if (expression) {
        expression = (-parseFloat(expression)).toString();
      }
      break;
    case "sqrt":
      if (expression) {
        expression = Math.sqrt(parseFloat(expression)).toString();
      }
      break;
    case "1/x":
      if (expression) {
        expression = (1 / parseFloat(expression)).toString();
      }
      break;
    case "x^2":
      if (expression) {
        expression = (parseFloat(expression) * parseFloat(expression)).toString();
      }
      break;
    case "=":
      evaluateExpression();
      break;
    default:
      expression += value;
  }
  updateDisplay();
}

// Ajout des événements sur les boutons
buttons.forEach(button => {
  button.addEventListener("click", () => {
    const value = button.dataset.value;
    handleInput(value);
  });
});
