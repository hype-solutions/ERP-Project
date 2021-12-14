// Gesture ERP
// Global functions


//Inputs to accept numbers only
function numbersOnly(input){
    input.value = input.value.replace(/[^0-9.]/g, '');
    input.value = input.value.replace(/(\..*)\./g, '$1');
}
