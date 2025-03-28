import {bootstrap} from '@tabler/core';

document.addEventListener('turbo:load', () => {
  const toastElList = document.querySelectorAll('.toast');
  const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));

  toastList.map((e) => e.show());
});
