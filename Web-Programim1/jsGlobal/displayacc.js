document.addEventListener('DOMContentLoaded', function(){
    var dropdownBtn = document.querySelector('.dropdown-btn');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownBtn.addEventListener('click', function() {
        dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
    });

    document.addEventListener('click', function (event) {
        if (!event.target.matches('.dropdown-btn')) {
            dropdownMenu.style.display = 'none';
        }
    });
});