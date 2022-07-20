let btnCatalog = document.querySelectorAll('.buy');
btnCatalog.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');
        (
            async () => {
                const response = await fetch("/basket/add/?id=" + id);
                const answer = await response.json();
                document.getElementById('count').innerText = answer.count;
            }
        )();
    });
});

let btnBasket = document.querySelectorAll('.basket-btn-del');
btnBasket.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');
        (
            async () => {
                const response = await fetch("/basket/del/?id=" + id);
                const answer = await response.json();
                document.getElementById('basket').remove();
                document.getElementById('count').innerText = answer.count;
            }
        )();
    });
});

