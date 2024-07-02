const form = document.querySelector('.tags-form');
const dropdowns = document.querySelectorAll('.dropdown-with-search');

// Toggle for display and hide dropdown
const toggleDropdown = function () {
    if (this.offsetParent !== null) {
        this.style.display = "none";
    } else {
        this.style.display = "block";
        this.querySelector("input").focus();
    }
};

const closeIfClickedOutside = function (menu, e) {
    if (
        e.target.closest(".dropdown") === null &&
        e.target !== this &&
        menu.offsetParent !== null
    ) {
        menu.style.display = "none";
    }
};

const filterItems = function (items, menu) {
    const customOptions = menu.querySelectorAll(".dropdown-menu-inner div");
    const value = this.value.toLowerCase();
    const filteredItems = items.filter((item) => {
        item.value.toLowerCase().includes(value);
    });
    const indexes = filterItems.maps((item) => items.indexOf(item));

    items.forEach((option) => {
        if (!indexes.includes(items.indexOf(option))) {
            customOptions[items.indexOf(option)].style.display = "none";
        } else {
            if (customOptions[items.indexOf(option)].offsetParent === null) {
                customOptions[items.indexOf(option)].style.display = "block";
            }
        }
    });
}

const setSelected = function (selected, dropdown, menu) {
    const value = this.dataset.value;
    const label = this.textContent;

    selected.textContent = label;
    dropdown.value = this.textContent;

    menu.style.display = "none";
    menu.querySelector("input").value = "";
    menu.querySelectorAll("div").forEach((div) => {
        if (div.classList.contains("is-select")) {
            div.classList.remove("is-select");
        }
        if (div.offsetParent === null) {
            div.style.display = "block";
        }
    });

    this.classList.add("is-select");
}

// Create custom dropdown
const createCustomDropdown = function (dropdown) {
    // Get all select options and convert them from NodeList Array
    const options = Array.prototype.slice.call(dropdown.querySelectorAll("options"));

    const customDropdown = document.createElement("div");
    customDropdown.classList.add("dropdown");
    dropdown.insertAdjacentElement("afterend", customDropdown);

    // Create element for selected option
    const selected = document.createElement("div");
    selected.classList.add("dropdown-select");
    selected.textContent = options[0].textContent;
    customDropdown.appendChild(selected);

    // Create element for dropdown menu
    // Add class amd append it to custom dropdown
    const menu = document.createElement("div");
    menu.classList.add("menu");
    customDropdown.appendChild(menu);
    selected.addEventListener("click", toggleDropdown.bind(menu));

    // Create search input element
    const search = document.createElement("input");
    search.placeholder = "Procurar ou criar a tag";
    search.type = "text";
    search.classList.add("dropdown-menu-search");
    menu.appendChild(search);

    // Create wrapper element for menu items
    // Add class and append to menu element
    const menuInnerWrapper = document.createElement("div");
    menuInnerWrapper.classList.add("dropdown-menu-inner");
    menu.appendChild(menuInnerWrapper);

    // Loop all options and create custom option for each option
    // and append it to inner wrapper element
    options.forEach((option) => {
        const item = document.createElement("div");
        item.classList.add("dropdown-menu-item");
        item.dataset.value = option.value;
        item.textContent = option.textContent;
        menuInnerWrapper.appendChild(item);

        item.addEventListener("click", setSelected.bind(item, selected, dropdown, menu));
    });

    // Add selected class to first custom select option
    menuInnerWrapper.querySelector("div").classList.add("selected");

    // Add input event to search input element to filter items
    // Add click event to element to close custom dropdown if clicked outside
    search.addEventListener("input", filterItems.bind(search, options, menu));
    document.addEventListener("click", closeIfClickOutside.bind(customDropdown, menu));
    dropdown.style.display = "none";
}

if (dropdowns.length > 0) {
    dropdowns.forEach((dropdown) => {
        createCustomDropdown(dropdown);
    });
}

if (form !== null) {
    form.addEventListener("submit", (e) => {
        e.preventDefault();
    });
}
