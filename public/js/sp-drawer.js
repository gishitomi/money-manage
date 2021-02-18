var hamburger = document.getElementById('hamburger');
var spBudgetMenu = document.getElementById('sp-budget-menu');

hamburger.addEventListener('click', function() {
    this.classList.toggle('open');
    spBudgetMenu.classList.toggle('open');
    overlay.classList.toggle('open');
})
overlay.addEventListener('click', function() {
    this.classList.remove('open');
    hamburger.classList.remove('open');
    spBudgetMenu.classList.remove('open');
})