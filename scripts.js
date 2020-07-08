const modal = document.getElementById('modal');

document.getElementById('modal-close').addEventListener('click', () => {
  modal.style.display = 'none';
});

document.getElementById('modal-open').addEventListener('click', () => {
  modal.style.display = 'block';
});

//Add a click on the outside to close
window.onclick = (event) => {
  if (event.target === modal) {
    modal.style.display = 'none';
  }
};
