const display = document.getElementById('display');
let currentValue = '';
let operator = '';
let storedValue = '';

function updateDisplay(value) {
  display.textContent = value;
}

function clearAll() {
  currentValue = '';
  operator = '';
  storedValue = '';
  updateDisplay('0');
}

document.querySelectorAll('.btn').forEach(button => {
  button.addEventListener('click', function () {
    const value = this.textContent;

    if (value >= '0' && value <= '9' || value === '.') {
      currentValue += value;
      updateDisplay(currentValue);
    } else if (value === 'AC') {
      clearAll();
    } else if (value === '=' && operator && storedValue !== '') {
      currentValue = calculate(storedValue, operator, currentValue);
      updateDisplay(currentValue);
      storedValue = '';
      operator = '';
    } else if (['+', '−', '×', '÷', '%'].includes(value)) {
      if (currentValue) {
        // Display the current calculation and operator
        operator = value;
        storedValue = currentValue;
        currentValue = '';
        updateDisplay(`${storedValue} ${operator}`);
      }
    }
  });
});

function calculate(num1, operator, num2) {
  const a = parseFloat(num1);
  const b = parseFloat(num2);
  
  switch (operator) {
    case '+': return a + b;
    case '−': return a - b;
    case '×': return a * b;
    case '÷': return a / b;
    case '%': return a % b;
    default: return num2;
  }
}

document.getElementById('clear').addEventListener('click', clearAll);
