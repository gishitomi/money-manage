var spendBtn = document.getElementById('spend-btn');
var incomBtn = document.getElementById('incom-btn');
var spendDrawer = document.getElementById('spend-drawer');
var incomDrawer = document.getElementById('incom-drawer');

var spendBack = document.getElementById('spend-back');
var incomBack = document.getElementById('incom-back');

var overlay = document.getElementById('overlay');

spendBtn.addEventListener('click', function() {
    spendDrawer.classList.add('open');
    overlay.classList.add('open');
})
incomBtn.addEventListener('click', function() {
    incomDrawer.classList.add('open');
    overlay.classList.add('open');
})

overlay.addEventListener('click', function() {
    this.classList.remove('open');
    spendDrawer.classList.remove('open');
    incomDrawer.classList.remove('open');
})

spendBack.addEventListener('click', function() {
    spendDrawer.classList.remove('open');
    overlay.classList.remove('open');
})

incomBack.addEventListener('click', function() {
    incomDrawer.classList.remove('open');
    overlay.classList.remove('open');
})