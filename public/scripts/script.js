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

let btnBasket = document.querySelectorAll('.delete');
btnBasket.forEach((elem) => {
    elem.addEventListener('click', () => {
        let id = elem.getAttribute('data-id');
        (
            async () => {
                const response = await fetch("/basket/delete/?id=" + id);
                const answer = await response.json();
                document.getElementById('count').innerText = answer.count;
                document.getElementById(id).remove();
            }
        )();
    });
});