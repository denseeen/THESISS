   // Dark Mode
   function toggleDarkModeDashboard() {
    document.body.classList.toggle('dark-mode');
    document.querySelectorAll('').forEach(item => {
        item.classList.toggle('dark-mode');
    });
}

    // DropDown
function toggleDropdown() {
    document.getElementById('dropdownMenu').classList.toggle('show');
}

window.onclick = function(event) {
    if (!event.target.closest('.profile-icon')) {
        var dropdowns = document.getElementsByClassName('dropdown-menu');
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// SideNav
document.addEventListener("DOMContentLoaded", function() {
  var li_items = document.querySelectorAll(".sidebar ul li");
  var hamburger = document.querySelector(".hamburger");

  li_items.forEach((li_item) => {
    li_item.addEventListener("mouseenter", () => {
      li_item.closest(".wrapper").classList.remove("hover_collapse");
    });
  });

  li_items.forEach((li_item) => {
    li_item.addEventListener("mouseleave", () => {
      li_item.closest(".wrapper").classList.add("hover_collapse");
    });
  });

  hamburger.addEventListener("click", () => {
    hamburger.closest(".wrapper").classList.toggle("hover_collapse");
  });
});