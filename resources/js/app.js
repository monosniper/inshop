import './bootstrap';

document.addEventListener("DOMContentLoaded", function(){

    // Header burger
    const header_toggler_selector = '.header__burger';
    const toggler = document.querySelector(header_toggler_selector)

    if(toggler) {
        const header_menu_selector = '.header__right';
        const header_active_class = 'active';
        const header_toggler_close_text = 'close';
        const header_toggler_burger_text = 'menu';

        toggler.addEventListener('click', () => {
            if(toggler.innerText === header_toggler_close_text) {
                toggler.querySelector('span').innerText = header_toggler_burger_text;
            } else {
                toggler.querySelector('span').innerText = header_toggler_close_text;
            }

            document.querySelector(header_menu_selector).classList.toggle(header_active_class);
        })
    }

    // Dropdowns logic
    const dropdowns = document.querySelectorAll('.dropdown');
    const dropdown_active_class = 'active';

    const clearDropdowns = () => {
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove(dropdown_active_class)
        })
    }

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', () => {
            const contains = dropdown.classList.contains(dropdown_active_class);

            clearDropdowns()

            !contains && dropdown.classList.add(dropdown_active_class)
        })
    })

});


