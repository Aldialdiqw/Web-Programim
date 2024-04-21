    document.addEventListener('DOMContentLoaded', function () {
    var watchListForms = document.querySelectorAll('.watchlist-form');

    watchListForms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            var watchListButton = form.querySelector('.add-to-watchlist');

            Swal.fire({
                position: "top-end",
                title: "Movie has been added to your Watchlist!",
                showConfirmButton: false,
                timer: 1500
            });

            // FORM SUBMIT (FETCH API)
            var formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // RESPONSE 
                if (data.status === 'error') {
                    // MOVIE EXISTS IN THE WATCHLST
                    Swal.fire({
                        position: "top-end",
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    console.error(data.message);
                } else {
                    // MOVIE HAS BEEN ADDED
                    Swal.fire({
                        position: "top-end",
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    console.log(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

