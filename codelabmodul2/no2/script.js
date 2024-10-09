function calculateSum() {
    var num1 = parseFloat(document.getElementById('firstNumber').value);
    var num2 = parseFloat(document.getElementById('secondNumber').value);
    
    // Calculate sum
    var sum = num1 + num2;
    
    // Display result
    document.getElementById('result').innerText = sum;
}
