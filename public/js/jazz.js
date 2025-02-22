document.getElementById('jazz-contact-form').addEventListener('submit', function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    // Agregar los campos extra al FormData
    formData.append('action', 'jazz_submit');
    formData.append('nonce', jazz.nonce);

    fetch( jazz.ajaxurl, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            let responseElement = document.createElement('div');
            responseElement.innerText = data.message;
            responseElement.className = 'alert alert-danger alert-dismissible fade show';
            
            let dissmissElement = document.createElement('button');
            dissmissElement.type = 'button';
            dissmissElement.className = 'btn-close';
            dissmissElement.setAttribute('data-bs-dismiss', 'alert');
            dissmissElement.setAttribute('aria-label', 'Close');
            dissmissElement.addEventListener('click', function() {
                responseElement.remove();
            });
            responseElement.appendChild(dissmissElement);

            document.querySelector('.jazz-alerts').appendChild(responseElement);
            return;
        } else {
            let responseElement = document.createElement('div');
            responseElement.innerText = data.message;
            responseElement.className = 'alert alert-success alert-dismissible fade show';

            let dissmissElement = document.createElement('button');
            dissmissElement.type = 'button';
            dissmissElement.className = 'btn-close';
            dissmissElement.setAttribute('data-bs-dismiss', 'alert');
            dissmissElement.setAttribute('aria-label', 'Close');
            dissmissElement.addEventListener('click', function() {
                responseElement.remove();
            });
            responseElement.appendChild(dissmissElement);
            document.querySelector('.jazz-alerts').appendChild(responseElement);
            this.reset();
        }
    });
});