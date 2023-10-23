'use strict';

const body = document.querySelector('body');
const img = document.querySelector('img');


img.onclick = function() {
  const modal = '<div class="modal"><img src="' + img.src + '" alt=""></div>';
  body.insertAdjacentHTML('afterbegin', modal);

  const modalClass = document.querySelector('.modal');
  modalClass.style.position = 'absolute';
  modalClass.style.width = '100%';

  modalClass.onclick = function() {
    body.removeChild(body.firstChild);
  }
}
