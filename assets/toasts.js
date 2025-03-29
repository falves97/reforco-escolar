import {bootstrap} from '@tabler/core';

document.addEventListener('turbo:load', () => {
  /* Trecho de código retirado da documentação do bootstrap: https://getbootstrap.com/docs/5.3/components/toasts/#usage*/
  const toastElList = document.querySelectorAll('.toast');
  const toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));

  toastList.map((e) => e.show());
});
